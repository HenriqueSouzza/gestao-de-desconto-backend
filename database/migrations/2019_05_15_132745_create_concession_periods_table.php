<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConcessionPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('concession_periods', function (Blueprint $table) {
            $table->bigIncrements('id_concession_period')->autoIncrement();            
            $table->integer('id_rm_establishment_concession_period')->comment('ID da Unidade do RM tabela GFILIAL, CAMPO: CODFILIAL');            
            $table->string('id_rm_modality_concession_period')->comment('ID da molidade do RM presencial ou EAD, CAMPO: CURPRESDIST');            
            $table->string('id_rm_course_type_concession_period')->comment('ID do nivel de ensino do RM , CAMPO: CODTIPOCURSO');            
            $table->integer('id_rm_period_concession_period')->comment('ID do periodo letivo do RM , CAMPO: IDPERLET');
            $table->string('id_rm_period_code_concession_period', 10)->comment('ID do codigo do periodo do RM, CAMPO: CODPERLET');
            $table->date('date_start_concession_period')->comment("Data inicial do periodo de concessao");
            $table->date('date_end_concession_period')->comment("Data inicial do periodo de concessao");            
            $table->integer('fk_user')->comment('ID do usuário referencia a tabela USERS');
            $table->timestamp('created_at_concession_period')->useCurrent();
            $table->timestamp('updated_at_concession_period')->nullable();
            $table->timestamp('deleted_at_concession_period')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('concession_periods');
    }
}
