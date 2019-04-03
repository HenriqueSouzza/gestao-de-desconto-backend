<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'paulo.silva@cnec.br',
        ]);

        factory(User::class)->create([
            'email' => 'henrique.souza@cnec.br',
        ]);

        factory(User::class)->create([
            'email' => 'caio.oliveira@cnec.br',
        ]);

        factory(User::class, 50)->create();

        
      
    }
}
