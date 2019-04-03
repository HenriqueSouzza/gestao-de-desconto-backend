<?php

use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionRole = PermissionRole::create([
            'fk_permission' => 1,
            'fk_role'       => 2,
        ]);

        $permissionRole = PermissionRole::create([
            'fk_permission' => 2,
            'fk_role'       => 2,
        ]);
    }
}
