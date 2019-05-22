<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountMarginEstablishmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_margin_establishment', function (Blueprint $table) {
            $table->bigIncrements('id_discount_margim_establishment')->autoIncrement();
            $table->string('id_rm_establishment_discount_margin_establishment',10)->comment('ID da unidade do RM tabela SBOLSA RM TOTVS');
            $table->integer('school_margin_discount_margin_establishment')->comment('Margem de desconto do colégio');
            $table->integer('college_margin_discount_margin_establishment')->comment('Margem de desconto do Faculdade');
            $table->integer('distance_margin_discount_margin_establishment')->comment('Margem de desconto do EAD');
            $table->integer('first_installment_discount_margin_establishment')->comment('Primeira parcela ou parcela inicial do desconto');
            $table->integer('last_installment_discount_margin_establishment')->comment('Primeira parcela ou parcela inicial do desconto');
            $table->integer('max_import_discount_margin_establishment')->comment('desconto máximo de importação');
            $table->timestamp('created_at_discount_margin_establishment')->useCurrent();
            $table->timestamp('updated_at_discount_margin_establishment')->nullable();
            $table->timestamp('deleted_at_discount_margin_establishment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_margin_establishment');
    }
}
