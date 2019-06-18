<?php

use Illuminate\Database\Seeder;
use App\Models\Action;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $action = Action::create([
            'name_action'  => 'Inserção'
        ]);
        
        $action = Action::create([
            'name_action'  => 'Edição'            
        ]);

        $action = Action::create([
            'name_action'  => 'Aprovação'            
        ]);
        $action = Action::create([
            'name_action'  => 'Deleção'            
        ]);
        $action = Action::create([
            'name_action'  => 'Tentativa de Aprovação'            
        ]);

    }
}
