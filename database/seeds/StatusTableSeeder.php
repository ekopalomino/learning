<?php

use Illuminate\Database\Seeder;
use iteos\Models\Status;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            'Draft',
            'Ongoing',
            'Completed',
            'Remedial',
            'Passed',
            'Failed',
            'Active',
            'Suspend',
            'Inactive',
            
        ];

        foreach($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}
