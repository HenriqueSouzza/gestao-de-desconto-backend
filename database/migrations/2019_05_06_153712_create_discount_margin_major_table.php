<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountMarginMajorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_margin_major', function (Blueprint $table) {
            $table->bigIncrements('id_discount_margin_major')->autoIncrement();
            $table->string('id_rm_establishment_discount_margin_major', 10)->comment('ID da unidade do RM tabela GFILIAL RM TOTVS');
            $table->string('id_rm_major_discount_margin_major', 10)->comment('ID do curso do RM tabela SCURSO RM TOTVS');
            $table->integer('value_discount_margin_major')->comment('Valor do desconto por curso');
            $table->timestamp('created_at_discount_margin_major')->useCurrent();
            $table->timestamp('updated_at_discount_margin_major')->nullable();
            $table->timestamp('deleted_at_discount_margin_major')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_margin_major');
    }
}
