<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_category';

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }

    public function jobs(){
        return $this->hasMany(Job::class, 'product_category_id', 'id');
    }
}
