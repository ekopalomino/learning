<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeOrganization extends Model
{
    protected $fillable = [
        'employee_id',
        'supervise'
    ];
}
