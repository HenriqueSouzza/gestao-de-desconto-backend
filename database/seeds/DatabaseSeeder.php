<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRolesTableSeeder::class);
        $this->call(RoleUsersTableSeeder::class);
        $this->call(ConcessionPeriodsSeeder::class);
        $this->call(DiscountMarginSchoolarshipsTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        //$this->call(CnecTableSeeder::class);
    }
}
