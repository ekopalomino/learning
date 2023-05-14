<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'Can View Training',
        ];

        foreach($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
