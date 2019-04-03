<?php

use Illuminate\Database\Seeder;
use App\Models\RoleUser;

class RoleUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::create([
        	'fk_role'	=>	'1',
        	'fk_user'	=>	'1',
        ]);
        
        RoleUser::create([
        	'fk_role'	=>	'1',
        	'fk_user'	=>	'2',
        ]);

        RoleUser::create([
        	'fk_role'	=>	'1',
        	'fk_user'	=>	'3',
        ]);
    }
}
