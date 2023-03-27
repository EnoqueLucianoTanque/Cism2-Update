<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskConformitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tc_task_conformities', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('tc_id')->unsigned()->index();
            $table->bigInteger('t_id')->unsigned();
            $table->bigInteger('c_id')->unsigned();
            $table->bigInteger('tc_created_by')->unsigned();
            $table->bigInteger('tc_updated_by')->unsigned();

            $table->foreign('tc_created_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('tc_updated_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('t_id')->references('t_id')->on('t_task')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('c_id')->references('c_id')->on('c_conformity')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('tc_task_conformities');
    }
}
