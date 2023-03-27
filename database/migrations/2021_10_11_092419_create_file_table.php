<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_file', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('f_id')->unsigned()->index();
            $table->text('f_description');
            $table->string('f_name');
            $table->string('f_path');
            $table->dateTime('f_start_date');
            $table->bigInteger('t_id')->unsigned()->nullable();
            $table->bigInteger('a_id')->unsigned()->nullable();
            $table->bigInteger('st_id')->unsigned()->nullable();
            $table->bigInteger('f_created_by')->unsigned();
            $table->bigInteger('f_updated_by')->unsigned();
            $table->foreign('t_id')->references('t_id')->on('t_task')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('a_id')->references('a_id')->on('a_article')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('st_id')->references('st_id')->on('st_sub_task')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('f_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('f_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('file');
    }
}
