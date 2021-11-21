<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobFormSetting extends Model
{
    use HasFactory;

    protected $table = 'jobs_form_settings';

    protected $guarded = [
        'id'
    ];
    
    public function productCategory(){
        return $this->hasOne(ProductCategory::class, 'id', 'product_category_id');
    }
}
