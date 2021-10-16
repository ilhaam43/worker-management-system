<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    use HasFactory;

    protected $table = 'superadmins';

    protected $guarded = [
        'id'
    ];

    public function user() 
    { 
        return $this->morphOne(User::class, 'userable');
    }
}
