<?php

namespace iteos\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'user_id',
        'employee_id',
        'division_id',
        'department_id',
        'employee_name',
        'job_title'
    ];

    public function Child()
    {
        return $this->hasMany(EmployeeOrganization::class);
    }

    public function Divisions()
    {
        return $this->belongsTo(Division::class,'division_id');
    }

    public function Departments()
    {
        return $this->belongsTo(Department::class,'department_id');
    }
}
