<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectMonitoringPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmp_project_monitoring_plans', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('pmp_id')->unsigned()->index();
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('pmp_created_by')->unsigned();
            $table->bigInteger('pmp_updated_by')->unsigned();
            $table->date('pmp_monitoring_date');
            $table->string('pmp_monitoring_schedule');
            $table->string('pmp_monitoring_schedule_document_path');
            $table->foreign('pmp_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pmp_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pmp_project_monitoring_plans');
    }
}
