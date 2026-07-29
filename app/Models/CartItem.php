<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'shop_id',
        'shop_product_id',
        'quantity',
        'attributes',
    ];
    protected $casts = [
        'attributes' => 'array',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function shopProduct(){
        return $this->belongsTo(ShopProduct::class);
    }
    //
}
