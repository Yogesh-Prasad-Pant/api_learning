<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\User;
use App\Models\ProductShop;
use App\Models\Order;
use App\Models\OrderItem;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::first();
       $shop = Shop::first();
       $inventory = ProductShop::where('shop_id', $shop->id)->first();
       if($user && $shop && $inventory){
            $order =  Order::create([
                'shop_id' => $shop->id,
                'user_id' => $user->id,
                'subtotal' => $inventory->price,
                'shipping_cost' => 100.00,
                'total_price' => $inventory->price + 100,
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'payment_method' => 'cod'
            ]);
             OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $inventory->product_id,
                'quantity' => 1,
                'unit_price' => $inventory->price,
                'total_item_price' => $inventory->price,
                'attributes' => json_encode(['size'=> 'M','color' => 'Default'])
            ]);
       }
       //
    }
}
