<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Shop;
use App\Models\ShopProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\ValidationException;

class OrderSettlementService
{
    /**
     * Settle vendor shop balance when an order is successfully delivered & paid.
     */
    public function settleOrder(Order $order): void
    {
        // 1. Guard checks to prevent double settlement or premature processing
        if ($order->is_credited) {
            return;
        }

        if ($order->status !== 'delivered' || $order->payment_status !== 'paid') {
            return;
        }

        DB::transaction(function () use ($order) {
            // Lock order row to guarantee single execution under heavy concurrency
            $lockedOrder = Order::where('id', $order->id)->lockForUpdate()->first();

            if ($lockedOrder->is_credited) {
                return;
            }

            // Lock shop row to safely mutate balance metrics
            $shop = Shop::where('id', $lockedOrder->shop_id)->lockForUpdate()->first();

            if (!$shop) {
                throw ValidationException::withMessages([
                    'shop' => ['Target shop for this order was not found.'],
                ]);
            }

            // Use the vendor earnings pre-calculated during checkout
            $vendorEarning = $lockedOrder->vendor_earning;

            // Increment vendor available balance
            $shop->increment('balance', $vendorEarning);

            // Increment lifetime total earnings if column exists
            if (Schema::hasColumn('shops', 'total_earnings')) {
                $shop->increment('total_earnings', $vendorEarning);
            }

            // Mark order as credited
            $lockedOrder->update([
                'is_credited' => true,
            ]);
        });
    }

    /**
     * Refund an order, reverse vendor earnings if credited, and restore shop inventory.
     */
    public function refundOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            $lockedOrder = Order::where('id', $order->id)->lockForUpdate()->first();

            // 1. If the shop was previously credited for this order, deduct earnings back
            if ($lockedOrder->is_credited) {
                $shop = Shop::where('id', $lockedOrder->shop_id)->lockForUpdate()->first();

                if ($shop) {
                    $refundDeduction = $lockedOrder->vendor_earning ?? 0.00;

                    // Deduct from available balance
                    $shop->decrement('balance', $refundDeduction);

                    // Deduct from lifetime total earnings
                    if (Schema::hasColumn('shops', 'total_earnings')) {
                        $shop->decrement('total_earnings', $refundDeduction);
                    }
                }
            }

            // 2. Restock ordered product items back to inventory via ShopProduct
            foreach ($lockedOrder->orderItems as $item) {
                if ($item->product_id) {
                    $shopProduct = ShopProduct::where('id', $item->product_id)
                        ->lockForUpdate()
                        ->first();

                    if ($shopProduct) {
                        $shopProduct->increment('stock', $item->quantity);
                        $shopProduct->update(['is_available' => true]);
                    }
                }
            }

            // 3. Update order settlement flags & payment status
            $lockedOrder->update([
                'is_credited'    => false,
                'status'         => 'returned',
                'payment_status' => 'refunded',
                'returned_at'    => now(),
            ]);
        });
    }
}