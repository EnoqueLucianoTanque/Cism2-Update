<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dp_document_project', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('dp_id')->unsigned()->index();
            $table->bigInteger('dt_id')->unsigned();
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('psm_id')->unsigned();
            $table->string('dp_name');
            $table->string('dp_description');
            $table->string('dp_local_path');
            $table->foreign('psm_id')->references('psm_id')->on('psm_project_stage_micro')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dt_id')->references('dt_id')->on('dt_document_type')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('dp_document_project');
    }
}
