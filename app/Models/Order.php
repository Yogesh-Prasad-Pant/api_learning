<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\HasShopScope;

class Order extends Model
{
    use SoftDeletes, HasFactory, HasShopScope;

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
        'is_credited',

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
        'returned_at',
        
        'customer_note',
        'admin_note',

        // Cancellation Fields
        'customer_received_at',
        'cancel_requested_at',
        'cancel_reason',
        'cancel_status',

        // Return & Refund Fields
        'return_requested_at',
        'return_reason',
        'return_status',

        // Delivery Integration Fields
        'delivery_type',
        'courier_name',
        'courier_waybill_id',
    ];

    protected $casts = [
        'subtotal'          => 'decimal:2',
        'shipping_cost'     => 'decimal:2',
        'discount_amount'   => 'decimal:2',
        'total_price'       => 'decimal:2',
        'commission_rate'   => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'vendor_earning'    => 'decimal:2',
        'is_credited'       => 'boolean',
        'shipping_address'  => 'array',
        'billing_address'   => 'array',
        
        // DateTime Casts
        'delivered_at'         => 'datetime',
        'cancelled_at'         => 'datetime',
        'returned_at'          => 'datetime',
        'customer_received_at' => 'datetime',
        'cancel_requested_at'  => 'datetime',
        'return_requested_at'  => 'datetime',
    ];

    /* -------------------------------------------------------------------------- */
    /*                               Relationships                                */
    /* -------------------------------------------------------------------------- */

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /* -------------------------------------------------------------------------- */
    /*                             Model Events & Boot                            */
    /* -------------------------------------------------------------------------- */

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
        do {
            $number = 'ORD-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(4));
        } while (static::where('order_number', $number)->exists());

        return $number;
    }

    /* -------------------------------------------------------------------------- */
    /*                           Business Logic Helpers                           */
    /* -------------------------------------------------------------------------- */

    /**
     * Helper to verify if vendor earnings can be released to shop balance.
     */
    public function canReleaseVendorFunds(): bool
    {
        if ($this->payment_method !== 'cod') {
            return $this->payment_status === 'paid' && !is_null($this->customer_received_at);
        }

        return $this->status === 'delivered';
    }

    /**
     * Helper to check if an order is eligible for a return request.
     */
    public function canBeReturned(): bool
    {
        return $this->status === 'delivered' && $this->return_status === 'none';
    }
}