<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->bigIncrements('id_action')->autoIncrement();
            $table->string('name_action', 100)->comment('Nome da ação que o usuario possa fazer');
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
        Schema::dropIfExists('actions');
    }
}
