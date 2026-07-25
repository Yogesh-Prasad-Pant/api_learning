<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        // 'shop_id',
        // 'admin_id',
        'name',
        'reason',
        'suggested_parent_id',
        'status',
        'admin_note',
    ];

    /* -------------------------------------------------------------------------- */
    /*                                RELATIONSHIPS                               */
    /* -------------------------------------------------------------------------- */

    /**
     * Get the shop that submitted the request.
     */
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    /**
     * Get the shop admin who created the request.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Get the suggested parent category (if provided).
     */
    public function suggestedParent()
    {
        return $this->belongsTo(Category::class, 'suggested_parent_id');
    }

  
    /**
     * Scope to filter pending requests for Superadmin review.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to filter approved requests.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope to filter rejected requests.
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
    //

