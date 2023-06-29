<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingAccumulation extends Model
{
    protected $fillable = [
        'employee_id',
        'employee_name',
        'employee_nik',
        'training_total',
        'hours_total',
        'avg_pre_score',
        'avg_post_score',
    ];
}
