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
        'job_title',
        'report_to',
        'report_to_second'
    ];

    public function Divisions()
    {
        return $this->belongsTo(Division::class,'division_id');
    }

    public function Departments()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function Parent()
    {
        return $this->belongsTo(Employee::class,'report_to','employee_id');
    }

    public function Children()
    {
        return $this->hasMany(Employee::class,'report_to','employee_id');
    }

    public function Logins()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
