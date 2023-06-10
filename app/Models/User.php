<?php

namespace iteos\Models;

use iteos\Traits\Uuid;
use iteos\Traits\LockableTrait;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, Uuid, HasRoles, LockableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',
        'employee_id', 
        'password',
        'avatar',
        'division_id',
        'department_id',
        'status_id',
        'last_login_at',
        'last_login_from',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $incrementing = false;

    public function Statuses()
    {
        return $this->belongsTo(Status::class,'status_id');
    }

    public function Divisions()
    {
        return $this->belongsTo(Division::class,'division_id');
    }

    public function Departments()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public function Services()
    {
        return $this->hasMany(EmployeeOrganization::class,'employee_id');
    }
}
