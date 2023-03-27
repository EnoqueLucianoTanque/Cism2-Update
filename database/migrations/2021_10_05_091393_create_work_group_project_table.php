<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkGroupProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wgp_work_group_project', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('wgp_id')->unsigned()->index();
            $table->string("wgp_name");
            $table->text("wgp_description");
            $table->dateTime('wgp_start_date');
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('ps_id')->unsigned()->default('1');

//            $table->bigInteger('wgm_id')->unsigned();
            $table->bigInteger('wgp_created_by')->unsigned();
            $table->bigInteger('wgp_updated_by')->unsigned();
            $table->foreign('ps_id')->references('ps_id')->on('ps_project_stage')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wgp_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wgp_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('work_group_project');
    }
}
