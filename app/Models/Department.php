<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'division_id',
        'department_name',
        'created_by',
        'updated_by',
    ];

    public function Divisions()
    {
        return $this->belongsTo(Division::class,'division_id');
    }
}
