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
        factory(User::class, 50)->create();

        factory(User::class)->create([
            'email' => 'paulo.silva@cnec.br',
        ]);
      
    }
}
