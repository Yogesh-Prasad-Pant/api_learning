<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'banner',
        'is_active',
        'is_featured',
        'order_priority',
        'website_url',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    
    protected $casts = [
        'is_active'      => 'boolean',
        'is_featured'    => 'boolean',
        'order_priority' => 'integer',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
        'deleted_at'     => 'datetime',
    ];

    public function products()
    {   
        return $this->hasMany(Product::class);
    }
}
