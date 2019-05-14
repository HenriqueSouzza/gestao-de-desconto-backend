<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchoolarshipWorkflowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schoolarship_workflows', function (Blueprint $table) {
            $table->bigIncrements('id_schoolarship_workflow');
            $table->integer('fk_user')->comment('ID do usuário referencia a tabela USERS');
            $table->integer('fk_student_schoolaship')->comment('ID da bolsa referencia a tabela STUDENT_SCHOOLARSHIP');
            $table->integer('fk_actions')->comment('ID da ação que o usuario fez referencia a tabela ACTIONS');
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
        Schema::dropIfExists('schoolarship_workflow');
        Schema::dropIfExists('schoolarship_workflows');
    }
}
