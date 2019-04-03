<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            
            $table->increments('id_permission');
            $table->string('name_permission', 50);
            $table->string('label_permission', 200);
            $table->string('action_permission', 200)->default('N/I');
            $table->timestamp('created_at_permission')->useCurrent();
            $table->timestamp('updated_at_permission')->nullable();
            $table->timestamp('deleted_at_permission')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
