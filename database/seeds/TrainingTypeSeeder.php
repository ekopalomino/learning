<?php

use Illuminate\Database\Seeder;
use iteos\Models\TrainingType;

class TrainingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'Kelas Offline',
            'Google Meet',
            'Zoom Meeting',
            'Zoom Webinar',
            'Microsoft Teams'
        ];

        foreach($types as $type) {
            TrainingType::create(['type_name' => $type]);
        }
    }
}
