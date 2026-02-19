<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total_item_price',
        'attributes',
    ];
    protected $casts = [
        'attributes' => 'json',
    ];
    public function order(){
        return $this->belognsTo(Order::class);
    }
    public function product(){
        return $this->belongsTo(Product::calss);
    }
    //
}
