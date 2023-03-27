<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCismProjectCollaboratorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpc_cism_project_collaborator', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('cpc_id')->unsigned()->index();

            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('cpc_cism_collaborator_id')->unsigned();
            $table->bigInteger('cpc_created_by')->unsigned();
            $table->bigInteger('cpc_updated_by')->unsigned();

            $table->foreign('cpc_cism_collaborator_id')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cpc_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cpc_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cpc_cism_project_collaborator');
    }
}
