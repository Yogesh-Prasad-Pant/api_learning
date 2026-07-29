<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shop;
use App\Models\ShopProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|array',
            'billing_address'  => 'nullable|array',
            'payment_method'   => 'required|string|in:cod,stripe,khalti,esewa',
            'customer_note'    => 'nullable|string|max:500',
        ]);

        $user = auth()->user();

        DB::beginTransaction();

        try {
            // Retrieve cart with row lock to prevent checkout race conditions
            $cart = Cart::with(['items.shopProduct.product'])
                ->where('user_id', $user->id)
                ->lockForUpdate()
                ->first();

            if (!$cart || $cart->items->isEmpty()) {
                return response()->json([
                    'message' => 'Your cart is empty.'
                ], 400);
            }

            $groupedItems = $cart->items->groupBy('shop_id');
            $createdOrders = [];

            foreach ($groupedItems as $shopId => $items) {
                $shop = Shop::findOrFail($shopId);

                $subtotal = 0;
                $orderItemsData = [];

                foreach ($items as $item) {
                    // Lock individual shop product row to safely re-verify stock
                    $shopProduct = ShopProduct::where('id', $item->shop_product_id)
                        ->lockForUpdate()
                        ->first();

                    if (!$shopProduct || !$shopProduct->is_available || $shopProduct->stock < $item->quantity) {
                        $productName = $item->shopProduct->product->name ?? 'Product';
                        throw new \Exception("Item '{$productName}' is out of stock or unavailable.");
                    }

                    $unitPrice = $shopProduct->effective_price;
                    $itemTotal = $unitPrice * $item->quantity;
                    $subtotal += $itemTotal;

                    $orderItemsData[] = [
                        'shop_product' => $shopProduct,
                        'product_id'   => $shopProduct->product_id,
                        'product_name' => $shopProduct->product->name,
                        'product_sku'  => $shopProduct->product->sku ?? null,
                        'quantity'     => $item->quantity,
                        'unit_price'   => $unitPrice,
                        'total_price'  => $itemTotal,
                        'attributes'   => $item->attributes,
                    ];
                }

                $shippingCost = 0.00; 
                $discountAmount = 0.00;
                $totalPrice = $subtotal + $shippingCost - $discountAmount;

                $commissionRate = $shop->commission_rate ?? 0.00;
                $commissionAmount = ($totalPrice * $commissionRate) / 100;
                $vendorEarning = $totalPrice - $commissionAmount;

                // Order model handles boot event for order_number auto-generation
                $order = Order::create([
                    'shop_id'           => $shopId,
                    'user_id'           => $user->id,
                    'subtotal'          => $subtotal,
                    'shipping_cost'     => $shippingCost,
                    'discount_amount'   => $discountAmount,
                    'total_price'       => $totalPrice,
                    'commission_rate'   => $commissionRate,
                    'commission_amount' => $commissionAmount,
                    'vendor_earning'    => $vendorEarning,
                    'status'            => 'pending',
                    'payment_status'    => 'pending',
                    'payment_method'    => $validated['payment_method'],
                    'customer_name'     => $validated['customer_name'],
                    'customer_phone'    => $validated['customer_phone'],
                    'shipping_address'  => $validated['shipping_address'],
                    'billing_address'   => $validated['billing_address'] ?? $validated['shipping_address'],
                    'customer_note'     => $validated['customer_note'] ?? null,
                ]);

                foreach ($orderItemsData as $itemData) {
                    OrderItem::create([
                        'order_id'         => $order->id,
                        'product_id'       => $itemData['product_id'],
                        'product_name'     => $itemData['product_name'],
                        'product_sku'      => $itemData['product_sku'],
                        'quantity'         => $itemData['quantity'],
                        'unit_price'       => $itemData['unit_price'],
                        'total_item_price' => $itemData['total_price'],
                        'attributes'       => $itemData['attributes'],
                    ]);

                    /** @var ShopProduct $shopProduct */
                    $shopProduct = $itemData['shop_product'];
                    $shopProduct->decrement('stock', $itemData['quantity']);

                    if ($shopProduct->fresh()->stock <= 0) {
                        $shopProduct->update(['is_available' => false]);
                    }
                }

                $createdOrders[] = $order->load('orderItems');
            }

            // Delete cart items
            $cart->items()->delete();

            DB::commit();

            return response()->json([
                'message' => 'Order(s) placed successfully.',
                'orders'  => $createdOrders,
            ], 201);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Failed to process order.',
                'error'   => $e->getMessage(),
            ], 422);
        }
    }

    public function index()
    {
        $orders = Order::with(['shop:id,shop_name,logo', 'orderItems'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return response()->json($orders);
    }

    public function show($id)
    {
        $order = Order::with(['shop:id,shop_name,logo', 'orderItems'])
            ->where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return response()->json($order);
    }
}