<?php

namespace iteos\Imports;

use iteos\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class UserImport implements ToModel, WithHeadingRow, WithBatchInserts
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
            'job_title' => $row['title'],
            'division_id' => $row['divisi'],
            'department_id' => $row['departemen'],
            'report_to' => $row['reporting'],
            'report_to_second' => $row['reporting_second'],
        ]);
    }

    public function batchSize(): int
    {
        return 50;
    }
}
