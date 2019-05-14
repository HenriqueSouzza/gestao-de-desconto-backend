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
            $table->bigIncrements('id_discount_margin_schoolarships')->autoIncrement();
            $table->string('id_rm_schoolarship',10)->comment('ID da bolsa do RM tabela SBOLSA');
            $table->integer('id_rm_establishment_schoolarship')->comment('ID da Unidade do RM tabela GFILIAL, CAMPO: CODFILIAL');
            $table->integer('id_rm_course_type_schoolarship')->comment('ID do Tipo do Curso do RM da tabela STIPOCURSO, CAMPO: IDTIPOCURSO');
            $table->integer('id_rm_modality_schoolarship')->comment('ID da molidade do RM presencial ou EAD, CAMPO: CURPRESDIST');
            $table->integer('id_rm_major_schoolarship')->comment('ID do Curso tabela SCURSO, CAMPO: CODCURSO');
            $table->decimal('max_value_schoolarship',3,2);
            $table->integer('is_exact_value_schoolarship');
            $table->timestamp('created_at_schoolarship')->useCurrent();
            $table->timestamp('updated_at_schoolarship')->nullable();
            $table->timestamp('deleted_at_schoolarship')->nullable();
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
