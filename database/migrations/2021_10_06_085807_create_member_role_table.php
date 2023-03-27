<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mr_member_role', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('mr_id')->unsigned()->index();
            $table->dateTime('mr_start_date');
            $table->bigInteger('wgm_id')->unsigned();
            $table->bigInteger('wgr_id')->unsigned();
            $table->bigInteger('mr_created_by')->unsigned();
            $table->bigInteger('mr_updated_by')->unsigned();
            $table->foreign('wgr_id')->references('wgr_id')->on('wgr_work_group_role')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wgm_id')->references('wgm_id')->on('wgm_work_group_member')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mr_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mr_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mr_member_role');
    }
}
