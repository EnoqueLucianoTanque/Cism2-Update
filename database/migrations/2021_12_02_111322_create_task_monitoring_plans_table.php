<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskMonitoringPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_task_monitoring_plans', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('tmp_id')->unsigned()->index();
            $table->bigInteger('t_id')->unsigned();
            $table->bigInteger('tmp_created_by')->unsigned();
            $table->bigInteger('tmp_updated_by')->unsigned();
            $table->date('tmp_monitoring_date');
            $table->string('tmp_monitoring_schedule');
            $table->string('tmp_monitoring_schedule_document_path');
            $table->foreign('tmp_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tmp_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('t_id')->references('t_id')->on('t_task')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('tmp_task_monitoring_plans');
    }
}
