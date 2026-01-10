<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'image',
        'banner',
        'parent_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        //'is_active',
        //'is_featured',
        'order_priority',
        'attributes',
        'icon',
        'is_menu',
        'depth',
        
    ];

    protected $casts = ['attributes' => 'array',
                        'is_active' => 'boolean',   
                        'is_featured' => 'boolean',
                        'commission_rate' => 'float',
                        'is_menu' => 'boolean',
                        'depth' => 'integer',
                       ];
    
    protected static function boot()
{
    parent::boot();
    static::creating(function ($category) {
        $category->slug = $category->slug ?? Str::slug($category->name);
        
        // Auto-calculate depth
        if ($category->parent_id) {
            $category->depth = $category->parent->depth + 1;
        }
    });
}
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
    public function children(){
        return $this->hasMany(Category::class, 'parent_id')->orderBy('order_priority', 'asc');
    }
    public function shops(){
        return $this->belongsToMany(Shop::class, 'category_shop');
    }
    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }
    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    // Recursive Parent Relationship (for Breadcrumbs)
    public function allParents()
    {
        return $this->parent()->with('allParents');
    }

    // Recursive Commission logic
    public function getEffectiveCommissionAttribute(): float
    {
        if ($this->commission_rate > 0) {
            return $this->commission_rate;
        }
        return $this->parent ? $this->parent->getEffectiveCommissionAttribute() : 0.00;
    }
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }
    public function scopeInMenu($query)
    {
        return $query->where('is_menu', true)->where('is_active', true);
    }
    public function scopeOrdered($query)
    {
        return $query->where('is_active', true)->orderBy('order_priority', 'asc');
    }

    //
}
