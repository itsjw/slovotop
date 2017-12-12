<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id');
            $table->integer('project_id');
            $table->integer('subject_id');
            $table->integer('price')->nullable();
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->text('words');
            $table->text('more_data')->nullable();
            $table->text('task');
            $table->longText('text_body')->nullable();
            $table->text('text_preview')->nullable();
            $table->string('text_url')->nullable();
            $table->integer('text_min')->nullable();
            $table->integer('text_max')->nullable();
            $table->text('text_unique')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
