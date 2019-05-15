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
            'email'    => 'paulo.silva@cnec.br',
            'password' => '$2y$10$O8pBxNUdpAxY/9lz90G6UOTE3fXRFNxPhwe9YJooSZ94omIwlAQqC'
        ]);

        factory(User::class)->create([
            'email' => 'henrique.souza@cnec.br',
            'password' => '$2y$10$O8pBxNUdpAxY/9lz90G6UOTE3fXRFNxPhwe9YJooSZ94omIwlAQqC'
        ]);

        factory(User::class)->create([
            'email' => 'caio.oliveira@cnec.br',
            'password' => '$2y$10$O8pBxNUdpAxY/9lz90G6UOTE3fXRFNxPhwe9YJooSZ94omIwlAQqC'
        ]);

        factory(User::class, 50)->create();

        
      
    }
}
