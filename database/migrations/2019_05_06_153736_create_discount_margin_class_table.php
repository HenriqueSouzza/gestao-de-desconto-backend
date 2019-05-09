<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountMarginClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_margin_class', function (Blueprint $table) {
            $table->bigIncrements('id_discount_margin_class')->autoIncrement();
            $table->string('id_rm_establishment_discount_margin_class', 10)->comment('ID da unidade do RM tabela GFILIAL RM TOTVS');
            $table->string('id_rm_class_discount_margin_class', 10)->comment('ID da turma do RM tabela STURMA RM TOTVS');
            $table->integer('value_discount_margin_class')->comment('Valor do desconto da por turma');
            $table->timestamp('created_at_discount_margin_class')->useCurrent();
            $table->timestamp('updated_at_discount_margin_class')->nullable();
            $table->timestamp('deleted_at_discount_margin_class')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_margin_class');
    }
}
