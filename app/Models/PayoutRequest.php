<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasShopScope;

class PayoutRequest extends Model
{
    use HasFactory, HasShopScope;

    protected $fillable = [
        'shop_id',
        'amount',
        'payment_method',
        'payment_details',
        'status',
        'admin_note',
        'processed_at',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'amount'          => 'decimal:2',
        'processed_at'    => 'datetime',
    ];

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }
}