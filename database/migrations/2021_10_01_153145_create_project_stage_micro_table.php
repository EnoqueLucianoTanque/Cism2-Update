<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStageMicroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psm_project_stage_micro', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('psm_id')->unsigned()->index();
            $table->bigInteger('ps_id')->unsigned();
            $table->bigInteger('psm_level')->unsigned();

            $table->bigInteger('psm_created_by')->unsigned();
            $table->bigInteger('psm_updated_by')->unsigned();

            $table->string('psm_name');
            $table->string('psm_description');

            $table->foreign('psm_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('psm_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ps_id')->references('ps_id')->on('ps_project_stage')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('psm_project_stage_micro');
    }
}
