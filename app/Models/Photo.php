<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';

    protected $guarded = [
        'id'
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
