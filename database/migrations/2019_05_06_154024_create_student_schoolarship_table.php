<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentSchoolarshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_schoolarship', function (Blueprint $table) {
            $table->bigIncrements('id_student_schoolarship');
            $table->integer('ra_rm_student_schoolarship')->comment('RA do estudante tabela SALUNO RM TOTVS');
            $table->string('id_rm_schoolarship_student_schoolarship',10)->comment('ID da bolsa tabela SBOLSA RM TOTVS');
            $table->string('id_rm_period_student_schoolarship',15)->comment('ID do periodo letivo tabela ? RM TOTVS');
            $table->string('id_rm_contract_student_schoolarship',15)->comment('ID do contrato tabela SCONTRATO RM TOTVS');
            $table->integer('id_rm_habilitation_establishment_student_schoolarship')->comment('ID da habilitação unidade tabela SHABILITACAOFILIAL RM TOTVS');
            $table->string('id_rm_establishment_student_schoolarship',15)->comment('ID da unidade do estudante tabela GFILIAL RM TOTVS');
            $table->string('id_rm_modality_major_student_schoolarship',15)->comment('ID da modalidade do curso (PRESENCIAL OU EAD) tabela ? RM TOTVS');
            $table->integer('id_rm_course_type_student_schoolarship')->comment('ID do tipo do curso tabela STIPOCURSO RM TOTVS');
            $table->integer('schoolarship_order_student_schoolarship')->comment('ID ordem da bolsa tabela ? RM TOTVS');
            $table->decimal('value_student_schoolarship',8,2)->comment('Valor percentual da bolsa do estudante');
            $table->integer('first_installment_student_schoolarship')->comment('Primeira parcela ou parcela inicial do desconto do aluno');
            $table->integer('last_installment_student_schoolarship')->comment('Ultima parcela ou parcela final do desconto do aluno');
            $table->string('detail_schoolarship_workflow',255);
            $table->timestamp('created_at_schoolarship_workflow')->useCurrent();
            $table->timestamp('updated_at_schoolarship_workflow')->nullable();
            $table->timestamp('deleted_at_schoolarship_workflow')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_schoolarship');
    }
}
