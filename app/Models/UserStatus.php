<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $table = 'users_status';

    protected $guarded = [
        'id'
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
