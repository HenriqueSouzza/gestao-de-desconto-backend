<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name_role'  => 'Administrador',
            'label_role' => 'Papel de administrador do sistema'
        ]);

        $role = Role::create([
            'name_role'  => 'Gerente Financeiro',
            'label_role' => 'Papel de gerente financeiro do sistema'
        ]);

        $role = Role::create([
            'name_role'  => 'Analista Financeiro',
            'label_role' => 'Papel de analista financeiro do sistema'
        ]);

        $role = Role::create([
            'name_role'  => 'Assistente Financeiro',
            'label_role' => 'Papel de assistente financeiro do sistema'
        ]);
    }
}
