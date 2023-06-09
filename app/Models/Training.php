<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
    	'training_id',
        'level',
        'category',
    	'training_name',
        'training_cover',
        'facilitator_id',
    	'minimum_score',
        'type_id',
        'description',
        'start_date',
        'end_date',
        'period',
        'status',
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

    public function Level()
    { 
        return $this->belongsTo(TrainingLevel::class,'level');
    }

    public function Trainers()
    {
        return $this->belongsTo(Facilitator::class,'facilitator_id');
    }

    public function Categories()
    {
        return $this->belongsTo(TrainingCategory::class,'category');
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status');
    }

    public function Peoples()
    {
        return $this->hasMany(TrainingPeople::class);
    }

    public function Classes()
    {
        return $this->belongsTo(TrainingType::class,'type_id');
    }
}
