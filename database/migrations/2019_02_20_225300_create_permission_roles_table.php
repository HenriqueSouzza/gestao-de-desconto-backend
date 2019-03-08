<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_roles', function (Blueprint $table) {
            
            $table->increments('id_permission_role');

            $table->integer('fk_permission')->unsigned();
            
            $table->foreign('fk_permission', 'constraint_fk_permission')
                    ->references('id_permission')
                    ->on('permissions')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('fk_role')->unsigned();
            
            $table->foreign('fk_role', 'constraint_fk_role')
                    ->references('id_role')
                    ->on('roles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamp('created_at_permission_role')->useCurrent();
            $table->timestamp('updated_at_permission_role')->nullable();
            $table->timestamp('deleted_at_permission_role')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_roles');
    }
}
