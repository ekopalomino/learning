<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingPeople extends Model
{
    protected $fillable = [
    	'training_id',
        'employee_nik',
        'employee_name',
        'pre_score',
        'post_score',
        'status_id'
    ];

    public function Trainings()
    {
        return $this->belongsTo(Training::class,'training_id');
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
