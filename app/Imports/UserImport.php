<?php

namespace iteos\Imports;

use iteos\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            'name' => $row['nama'],
            'email' => $row['email'],
            'employee_id' => $row['nik'],
            'division_id' => $row['divisi'],
            'department_id' => $row['departemen'],
        ]);
    }
}
