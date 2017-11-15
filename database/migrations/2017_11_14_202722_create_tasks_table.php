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
            $table->integer('status_id');
            $table->integer('stage_id');
            $table->integer('editor_id')->nullable();
            $table->integer('author_id')->nullable();
            $table->integer('subject_id');
            $table->timestamp('date_end');
            $table->integer('price');
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->text('words');
            $table->text('more_data')->nullable();
            $table->text('task');
            $table->text('rule_text');
            $table->longText('text_body');
            $table->integer('log_id');
            $table->text('preview_text');
            $table->string('url');
            $table->integer('text_min');
            $table->integer('text_max');
            $table->text('text_unique');
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
