<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $guarded = [
        'id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function productCategory(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function jobStatus(){
        return $this->belongsTo(JobStatus::class, 'job_status_id', 'id');
    }
}
