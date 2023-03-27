<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsortiumMemberProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cmp_consortium_member_project', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('cmp_id')->unsigned()->index();
            $table->string('cmp_name');
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('cmr_id')->unsigned();
            $table->bigInteger('cmp_created_by')->unsigned();
            $table->bigInteger('cmp_updated_by')->unsigned();
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cmr_id')->references('cmr_id')->on('cmr_consortium_member_role')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cmp_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cmp_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('cmp_consortium_member_project');
    }
}
