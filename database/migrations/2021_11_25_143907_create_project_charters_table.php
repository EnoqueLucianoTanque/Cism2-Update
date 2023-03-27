<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectChartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pc_project_charters', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('pc_id')->unsigned()->index();
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('pc_updated_by')->unsigned();
            $table->bigInteger('pc_created_by')->unsigned();
            $table->string('pc_objective');
            $table->string('pc_acronym');
            $table->string('pc_pi');
            $table->string('pc_co_pi');
            $table->date('pc_start_date');
            $table->date('pc_end_date');
            $table->string('p_target_population');
            $table->string('p_data_collection_location');
            $table->string('p_main_procedure');
            $table->string('p_actual_state');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pc_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pc_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pc_project_charters');
    }
}
