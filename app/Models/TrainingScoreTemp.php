<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingScoreTemp extends Model
{
    protected $fillable = [
    	'training_id',
        'employee_nik',
        'employee_name',
        'pre_score',
        'post_score',
        'status_id'
    ];
}
