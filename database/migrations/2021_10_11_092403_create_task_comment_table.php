<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_task_comment', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('tc_id')->unsigned()->index();
            $table->text('tc_description');
            $table->dateTime('tc_start_date');
            $table->bigInteger('t_id')->unsigned()->nullable();
            $table->bigInteger('st_id')->unsigned()->nullable();
            $table->bigInteger('s_id')->unsigned()->nullable();
            $table->bigInteger('tc_created_by')->unsigned();
            $table->bigInteger('tc_updated_by')->unsigned();
            $table->foreign('s_id')->references('s_id')->on('s_staff')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('t_id')->references('t_id')->on('t_task')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('st_id')->references('st_id')->on('st_sub_task')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tc_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tc_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tc_task_comment');
    }
}
