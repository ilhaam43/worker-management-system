<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userable()
    {
        return $this->morphTo();
    }
    
    public function userStatus(){
        return $this->belongsTo(UserStatus::class, 'status_id', 'id');
    }

    public function jobs(){
        return $this->hasMany(Job::class, 'user_id', 'id');
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function workerNotifications(){
        return $this->hasMany(WorkerNotification::class, 'user_id', 'id');
    }
}
