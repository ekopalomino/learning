<?php

use Illuminate\Database\Seeder;
use iteos\Models\OrganizationGroup;

class OrganizationGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            'Agrinesia Group',
            'PT. Agrinesia Raya Cabang Bogor',
            'PT. Agrinesia Raya Cabang Bandung',
            'PT. Agrinesia Raya Cabang Yogyakarta',
            'PT. Agrinesia Raya Cabang Surabaya',
            'PT. Agrinesia Raya Cabang Malang',
            'PT. Agrinesia Raya Cabang Medan',
        ];

        foreach($groups as $group) {
            OrganizationGroup::create(['group_name' => $group]);
        }
    }
}
