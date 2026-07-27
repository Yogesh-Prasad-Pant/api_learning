<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ShopProduct extends Pivot
{   
    use HasFactory, SoftDeletes;
    protected $table = 'shop_products';
   
    public $incrementing = true; 


    protected $fillable = [
        // 'product_id', 
        // 'shop_id', 
        'price', 
        'sale_price', 
        'stock',
        'sale_start',
        'sale_end',
        'min_order',
        'max_order', 
        'local_image', 
        'last_stock_update', 
        'is_available'
    ];

    protected $casts = [
        'price' => 'decimal:2',        
        'sale_price' => 'decimal:2',
        'last_stock_update' => 'datetime',
        'is_available' => 'boolean',
        'sale_start' => 'datetime', 
        'sale_end' => 'datetime',
    ];

    /**
     * Boot logic to automatically update 'last_stock_update' 
     * whenever price or stock is changed by the shopkeeper.
     */
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($pivot) {
            if ($pivot->isDirty('stock') || $pivot->isDirty('price')) {
                $pivot->last_stock_update = now();
            }
        });
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    // 3. Add helper for effective price calculation:
    public function getEffectivePriceAttribute(): float
    {
        if ($this->sale_price && $this->sale_price > 0) {
            $now = now();
            $startValid = !$this->sale_start || $now->gte($this->sale_start);
            $endValid   = !$this->sale_end || $now->lte($this->sale_end);

            if ($startValid && $endValid) {
                return (float) $this->sale_price;
            }
        }

        return (float) $this->price;
    }
    //
}
