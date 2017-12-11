<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');
            $table->integer('state_id');
            $table->integer('stage_id');
            $table->integer('user_id');
            $table->integer('active_stage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_steps');
    }
}
