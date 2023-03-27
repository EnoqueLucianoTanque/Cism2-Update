<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkGroupMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wgm_work_group_member', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('wgm_id')->unsigned()->index();
            $table->string("wgm_name");
            $table->text("wgm_description");
            $table->dateTime('wgm_start_date');
            $table->bigInteger('s_id')->unsigned();
            $table->bigInteger('wgp_id')->unsigned();
            $table->bigInteger('wgr_id')->unsigned();
            $table->bigInteger('wgm_created_by')->unsigned();
            $table->bigInteger('wgm_updated_by')->unsigned();
            $table->foreign('wgp_id')->references('wgp_id')->on('wgp_work_group_project')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wgr_id')->references('wgr_id')->on('wgr_work_group_role')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wgm_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wgm_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('wgm_work_group_member');
    }
}
