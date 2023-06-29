<?php

namespace iteos\Imports;

use iteos\Models\User;
use iteos\Models\Employee;
use iteos\Models\EmployeeOrganization;
use iteos\Models\TrainingAccumulation;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Hash;

class UserImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts, WithValidation
{
    public $data;
    public function __construct()
    {
        $this->data = collect();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $model = User::create([
            'id' => Uuid::uuid4(),
            'name' => $row['nama'],
            'email' => $row['email'],
            'employee_id' => $row['nik'],
            'job_title' => $row['title'],
            'password' => Hash::make('123456'),
            'division_id' => $row['divisi'],
            'department_id' => $row['departemen'],
            'group_id' => $row['group'],
        ]);
        
        $employees = Employee::create([
            'user_id' => $model->id,
            'employee_id' => $model->employee_id,
            'job_title' => $row['title'],
            'division_id' => $row['divisi'],
            'department_id' => $row['departemen'],
            'employee_name' =>$model->name,
            'group_id' => $row['group'],
            'report_to' => $row['reporting'],
        ]);

        $organizations = EmployeeOrganization::create([
            'employee_id' => $employees->id,
            'reporting' => $row['reporting'],
        ]);

        $records = TrainingAccumulation::create([
            'employee_id' => $employees->id,
            'employee_name' =>$model->name,
            'employee_nik' => $model->employee_id,
        ]);
        
        $model->assignRole($row['roles']);
    }

    public function chunkSize(): int
    {
        return 50;
    }

    public function batchSize(): int
    {
        return 50;
    }

    public function rules(): array
    {
        return [
            'email' => 'unique:users,email',
        ];
    }
}
