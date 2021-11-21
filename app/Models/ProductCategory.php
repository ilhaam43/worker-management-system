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

    public function settings()
    {
        return $this->hasMany(Setting::class, 'product_category_id', 'id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'product_category_id', 'id');
    }

    public function JobFormsetting()
    {
        return $this->belongsTo(JobFormSetting::class);
    }
}
