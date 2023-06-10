<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeOrganization extends Model
{
    protected $fillable = [
        'employee_id',
        'supervise',
        'supervise_second',
    ];

    public function Parent()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
