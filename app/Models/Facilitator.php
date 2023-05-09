<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Facilitator extends Model
{
    protected $fillable = [
        'facilitator_name',
        'facilitator_picture',
        'descriptions',
        'status',
        'created_by',
        'updated_by'
    ];

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status');
    }
}
