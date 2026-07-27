<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',      // Snapshot field
        'product_sku',       // Snapshot field
        'quantity',
        'unit_price',
        'total_item_price',
        'attributes',
    ];

    protected $casts = [
        'unit_price'       => 'decimal:2',
        'total_item_price' => 'decimal:2',
        'attributes'       => 'array', // Automatically decodes JSON to array
    ];
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }
    //
}
