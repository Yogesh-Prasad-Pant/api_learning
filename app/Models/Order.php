<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'shop_id', 
        'user_id',
        'order_number',

        'subtotal', 
        'shipping_cost',
        'discount_amount',
        'total_price',
        'commission_rate',
        'commission_amount',
        'vendor_earning',

        'status',
        'payment_status',
        'payment_method',
        'transaction_id',

        'customer_name',
        'customer_phone',
        'shipping_address',
        'billing_address',

        'tracking_number',
        'delivered_at',
        'cancelled_at',
        
        'customer_note',
        'admin_note',
    ];
    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_price' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'vendor_earning' => 'decimal:2',
        'shipping_address' => 'array', // Automatically decodes JSON to array
        'billing_address' => 'array',  // Automatically decodes JSON to array
        'delivered_at' => 'datetime',  // Converts string to Carbon date instance
        'cancelled_at' => 'datetime',
    ];
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    protected static function booted()
    {
        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateUniqueOrderNumber();
            }
        });
    }

    protected static function generateUniqueOrderNumber(): string
    {
        // Timestamp + random digits is faster and collision-free
        do {
            $number = 'ORD-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4));
        } while (static::where('order_number', $number)->exists());

        return $number;
    }
    //
}
