<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'workers';

    protected $guarded = [
        'id'
    ];

    public function user() 
    { 
        return $this->morphOne(User::class, 'userable');
    }
}
