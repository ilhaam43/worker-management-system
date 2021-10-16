<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    use HasFactory;

    protected $table = 'jobs_status';

    protected $guarded = [
        'id'
    ];
    
    public function jobs(){
        return $this->hasMany(Job::class, 'id', 'job_status_id');
    }
}
