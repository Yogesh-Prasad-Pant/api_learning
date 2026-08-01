<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Shop;
use App\Models\Product;
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
            // Lock shop row to safely mutate balance metrics
            $shop = Shop::where('id', $order->shop_id)->lockForUpdate()->first();

            if (!$shop) {
                throw ValidationException::withMessages([
                    'shop' => ['Target shop for this order was not found.'],
                ]);
            }

            // 2. Calculate platform commission & vendor net earnings
            $commissionRate   = $shop->commission_rate ?? 0.00; // e.g. 10.00%
            $grossAmount       = $order->total_price; // Order total including items & shipping
            $commissionAmount  = ($grossAmount * $commissionRate) / 100;
            $vendorEarning     = $grossAmount - $commissionAmount;

            // 3. Increment vendor available balance
            $shop->increment('balance', $vendorEarning);

            // Increment lifetime total earnings if column exists
            if (Schema::hasColumn('shops', 'total_earnings')) {
                $shop->increment('total_earnings', $vendorEarning);
            }

            // 4. Update order settlement flags
            $order->update([
                'is_credited'       => true,
                'commission_amount' => $commissionAmount,
                'vendor_earning'    => $vendorEarning,
            ]);
        });
    }
    public function refundOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            // 1. If the shop was previously credited for this order, deduct earnings back
            if ($order->is_credited) {
                $shop = Shop::where('id', $order->shop_id)->lockForUpdate()->first();

                if ($shop) {
                    $refundDeduction = $order->vendor_earning ?? 0.00;

                    // Deduct from available balance
                    $shop->decrement('balance', $refundDeduction);

                    // Deduct from lifetime total earnings
                    if (Schema::hasColumn('shops', 'total_earnings')) {
                        $shop->decrement('total_earnings', $refundDeduction);
                    }
                }
            }

            // 2. Restock ordered product items back to inventory
            foreach ($order->orderItems as $item) {
                if ($item->product_id) {
                    Product::where('id', $item->product_id)->increment('stock', $item->quantity);
                }
            }

            // 3. Update order settlement flags & payment status
            $order->update([
                'is_credited'    => false,
                'status'         => 'returned',
                'payment_status' => 'refunded',
                'returned_at'    => now(),
            ]);
        });
    }
}