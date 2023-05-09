<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Quesioner extends Model
{
    protected $fillable = [
    	'training_id',
        'questioner_title',
        'status_id',
    	'created_by',
    	'updated_by',
    ];

    public function Author()
    {
        return $this->belongsTo(User::class,'created_by');
    }

    public function Editor()
    {
        return $this->belongsTo(User::class,'updated_by');
    }

    public function Trainings()
    {
        return $this->belongsTo(Training::class,'training_id');
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
