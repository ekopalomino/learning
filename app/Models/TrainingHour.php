<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingHour extends Model
{
    protected $fillable = [
    	'training_id',
        'avg_score',
        'participants',
    ];

    public function Trainings()
    {
        return $this->belongsTo(Training::class,'training_id');
    }
}
