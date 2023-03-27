<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectExternalStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pes_project_external_state', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('pes_id')->unsigned()->index();
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('ecs_id')->unsigned();
            $table->bigInteger('pes_updated_by')->unsigned();
            $table->bigInteger('pes_created_by')->unsigned();
            $table->string('pes_document_path')->nullable();
            $table->foreign('pes_created_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('pes_updated_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('ecs_id')->references('ecs_id')->on('ecs_external_committee_states')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('pes_project_external_state');
    }
}
