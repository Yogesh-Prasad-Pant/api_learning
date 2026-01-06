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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'deleted_at'=>'datetime',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    
}
