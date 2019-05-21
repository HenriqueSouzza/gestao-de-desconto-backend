<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountMarginSchoolarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_margin_schoolarships', function (Blueprint $table) {
            $table->bigIncrements('id_discount_margin_schoolarship')->autoIncrement();
            $table->string('id_rm_schoolarship_discount_margin_schoolarship',10)->comment('ID da bolsa do RM tabela SBOLSA');
            $table->integer('id_rm_establishment_discount_margin_schoolarship')->comment('ID da Unidade do RM tabela GFILIAL, CAMPO: CODFILIAL');
            $table->integer('id_rm_course_type_discount_margin_schoolarship')->comment('ID do Tipo do Curso do RM da tabela STIPOCURSO, CAMPO: IDTIPOCURSO');
            $table->string('id_rm_modality_discount_margin_schoolarship')->comment('ID da molidade do RM presencial ou EAD, CAMPO: CURPRESDIST');
            $table->string('id_rm_major_discount_margin_schoolarship')->comment('ID do Curso tabela SCURSO, CAMPO: CODCURSO');
            $table->integer('id_rm_period_discount_margin_schoolarship')->comment('ID do periodo letivo do RM , CAMPO: IDPERLET');
            $table->string('id_rm_period_code_discount_margin_schoolarship', 10)->comment('ID do codigo do periodo do RM, CAMPO: CODPERLET');
            $table->decimal('max_value_discount_margin_schoolarship',6,2)->comment("Valor máximo");
            $table->integer('is_exact_value_discount_margin_schoolarship')->comment("Se o valor é teto ou fixo");   
            $table->integer('first_installment_discount_margin_schoolarship')->comment('Primeira parcela ou parcela inicial do desconto do aluno');
            $table->integer('last_installment_discount_margin_schoolarship')->comment('Ultima parcela ou parcela final do desconto do aluno');
            $table->integer('fk_user')->comment('ID do usuário referencia a tabela USERS');         
            $table->timestamp('created_at_discount_margin_schoolarship')->useCurrent();
            $table->timestamp('updated_at_discount_margin_schoolarship')->nullable();
            $table->timestamp('deleted_at_discount_margin_schoolarship')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_margin_schoolarships');
    }
}
