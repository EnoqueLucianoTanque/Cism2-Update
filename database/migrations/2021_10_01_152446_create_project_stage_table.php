<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ps_project_stage', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('ps_id')->unsigned()->index();

            $table->string('ps_name');
            $table->string('ps_description');
            $table->bigInteger('ps_created_by')->unsigned();
            $table->bigInteger('ps_updated_by')->unsigned();

            $table->foreign('ps_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ps_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('ps_project_stage');
    }
}
