<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        //'role',
        'contact_no',
        'address',
        'password',
        'image',
        //'status',
        'referred_by',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_verified' => 'boolean',
        'password' => 'hashed',
        
    ];
    public function shops()
        {
            return $this->hasMany(Shop::class, 'admin_id');
        }
    public function isSuperAdmin(): bool
        {
            return $this->role === 'superadmin';
        }
    public function scopeOnlyActive($query)
      {
        return $query->where('status', 'active');
        }

    public function scopePendingKyc($query) {
        return $query->where('kyc_status', 'pending');
    }

     public function isVerified(): bool
        {
            return $this->kyc_status === 'verified';
        }
    public function canOperate(): bool
    {
        return $this->status === 'active' && $this->kyc_status === 'verified';
    }
    
    
}
