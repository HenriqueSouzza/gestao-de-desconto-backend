<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEstablishmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_establishment', function (Blueprint $table) {
            $table->bigIncrements('id_user_establishment')->autoIncrement();
            $table->string('fk_user', 10)->comment('Referencia ao ID_user da tabela User');
            $table->string('id_rm_establishment_user_establishment', 10)->comment('ID do pólo do RM tabela GFILIAL RM TOTVS');
            $table->timestamp('created_at_user_establishment')->useCurrent();
            $table->timestamp('updated_at_user_establishment')->nullable();
            $table->timestamp('deleted_at_user_establishment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_establishment');
    }
}
