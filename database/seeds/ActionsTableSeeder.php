<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $action = Role::create([
            'name_actions'  => 'Inserção'
        ]);

        $action = Role::create([
            'name_actions'  => 'Aprovação'            
        ]);

    }
}
