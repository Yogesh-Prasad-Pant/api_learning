<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name', 
        'brand_id',
        'slug', 
        'description',
        'video_url',
        'has_variants',
        'catalog_image',
        'attributes',
        'unit'
    ];
    protected $casts = [
        'is_verified' => 'boolean',
        'has_variants' => 'boolean',
        'attributes' => 'array',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($product){
             $product->slug = $product->slug ?? Str::slug(($product->name)); 
             if (auth('admin')->check() && !$product->creator_id) {
                $product->creator_id = auth('admin')->id();
            }   
        });
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function images(){
        return $this->hasMany(ProductImage::class)->orderBy('sort_order', 'asc');

    }
    public function shops(){
        return $this->belongsToMany(Shop::class, 'shop_products')
        ->using(ShopProduct::class)
        ->withPivot(['price', 'sale_price', 'stock', 'local_image', 'last_stock_update', 'is_available','sale_start','sale_end'])
        ->withTimestamps();
    }

    

    //
}
