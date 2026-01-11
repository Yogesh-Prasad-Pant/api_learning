<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductShop extends Pivot
{
    protected $table = 'product_shop';

    public $incrementing = true; 


    protected $fillable = [
        'product_id', 
        'shop_id', 
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
        'last_stock_update' => 'datetime',
        'is_available' => 'boolean',
        'sale_start' => 'datetime', // Recommended
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
    //
}
