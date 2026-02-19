<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'shop_id', 
        'user_id',
        'subtotal',
        'tax', 
        'shipping_cost',
        'discount_amount',
        'total_price',
        'status',
        'payment_status',
        'payment_method',
        'transaction_id',
        'shipping_address',
        'tracking_number',
        'delivered_at',
        'admin_note'
    ];

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function user(){
        return $this->belognsTo(User::class);
    }
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    //
}
