<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_users', function (Blueprint $table) {
            
            $table->increments('id_role_user');
            $table->integer('fk_role')->unsigned();
            
            $table->foreign('fk_role', 'constraint_fk_role2')
                    ->references('id_role')
                    ->on('roles')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->integer('fk_user')->unsigned();
            
            $table->foreign('fk_user', 'constraint_fk_user2')
                    ->references('id')
                    ->on('users')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->timestamp('created_at_role_user')->useCurrent();
            $table->timestamp('updated_at_role_user')->nullable();
            $table->timestamp('deleted_at_role_user')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_users');
    }
}
