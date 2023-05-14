<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'division_id',
        'department_name',
        'status_id',
        'created_by',
        'updated_by',
    ];

    public function Divisions()
    {
        return $this->belongsTo(Division::class,'division_id');
    }

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status_id');
    }
}
