<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingMaterial extends Model
{
    protected $fillable = [
        'training_id',
        'filename',
    ];

    public function Trainings()
    {
        return $this->belongsTo(Training::class,'training_id');
    }
}
