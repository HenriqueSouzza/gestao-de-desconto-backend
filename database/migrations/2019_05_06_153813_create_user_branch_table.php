<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_branch', function (Blueprint $table) {
            $table->bigIncrements('id_user_branch')->autoIncrement();
            $table->string('fk_user', 10)->comment('Referencia ao ID_user da tabela User');
            $table->string('id_rm_branch_user_branch', 10)->comment('ID do pólo do RM tabela ? RM TOTVS');
            $table->timestamp('created_at_user_branch')->useCurrent();
            $table->timestamp('updated_at_user_branch')->nullable();
            $table->timestamp('deleted_at_user_branch')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_branch');
    }
}
