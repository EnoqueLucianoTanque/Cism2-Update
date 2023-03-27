<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectConformitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_project_conformities', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('pc_id')->unsigned()->index();
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('c_id')->unsigned();
            $table->bigInteger('pc_created_by')->unsigned();
            $table->bigInteger('pc_updated_by')->unsigned();

            $table->foreign('pc_created_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('pc_updated_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('pc_project_conformities');
    }
}
