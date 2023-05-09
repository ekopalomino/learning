<?php

namespace iteos\Imports;

use iteos\Models\TrainingPeople;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrainingPeopleImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TrainingPeople([
            'employee_nik' => $row['id'],
            'employee_name' => $row['name'],
        ]);
    }
}
