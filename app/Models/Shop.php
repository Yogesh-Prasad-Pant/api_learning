<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use SoftDeletes, HasFactory;
    protected $fillable = [
        'admin_id', 
        'slug', 
        'shop_name', 
        'logo', 
        'cover_image',
        'theme_color', 
        'business_email', 
        'map_location',
        'contact_no', 
        'address', 
        'status', 
        'is_open',
        // 'is_featured', 
        // 'rating',
        'social_links',
        'meta_title', 
        'description', 
        'meta_description',
        'latitude', 
        'longitude',];

    protected $casts = [ 'social_links' => 'array',
                         'commission_rate' => 'float',
                         'balance' => 'float',
                        'is_featured' => 'boolean',
                        'is_open' => 'boolean',
                        'rating' => 'float',
                        'reviews_count' => 'integer',
                        
                        
            ];

    public function owner(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'category_shop');
    }
    public function scopeNear($query, $latitude, $longitude, $radiusInKm = 10)
{
    $haversine = "(6371 * acos(cos(radians(?)) * cos(radians(latitude)) 
                  * cos(radians(longitude) - radians(?)) 
                  + sin(radians(?)) * sin(radians(latitude))))";

    return $query->select('*')
                 ->selectRaw("{$haversine} AS distance", [$latitude, $longitude, $latitude])
                 ->whereRaw("{$haversine} < ?", [$latitude, $longitude, $latitude, $radiusInKm])
                 ->orderBy('distance');
}
    //
}
