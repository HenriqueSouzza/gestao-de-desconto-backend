<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //busca todas as permissões de acordo com o nome e ações das controllers
        foreach (\Route::getRoutes()->getRoutes() as $route)
        {
             $action = $route->getAction();
            if (array_key_exists('controller', $action))
            {
                $controller = explode('\\', $action['controller']);
                $index = max(array_keys($controller));
                $actionPermission = explode('@', $controller[$index]);
                $actionName = ( array_key_exists('as', $action) ? $action['as'] : '' );
                
                $find = Permission::where('name_permission', $controller[$index])->count();
              
                if(!$find)
                {
                    $data = Permission::insert([
                        'name_permission'   =>   $controller[$index],
                        'label_permission'  =>  'Acesso a ação '.$actionPermission[1],
                        'action_permission' =>   $actionName,
                    ]);
                }
            }
        }
    }
}
