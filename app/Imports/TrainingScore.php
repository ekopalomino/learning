<?php

namespace iteos\Imports;

use iteos\Models\TrainingPeople;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TrainingScore implements ToModel
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
            'pre_score' => $row['pre_test'],
            'post_score' => $row['post_test'],
            'status_id' => $row['status']
        ]);
    }
}
