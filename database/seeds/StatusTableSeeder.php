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
            'On Leave',
            'No Show'
        ];

        foreach($statuses as $status) {
            Status::create(['name' => $status]);
        }
    }
}
