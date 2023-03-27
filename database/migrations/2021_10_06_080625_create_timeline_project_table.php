<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimelineProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tp_timeline_project', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('tp_id')->unsigned()->index();
            $table->bigInteger('p_id')->unsigned();
            $table->date('tp_start_at');
            $table->date('tp_end_date');

            $table->bigInteger('tp_created_by')->unsigned();
            $table->bigInteger('tp_updated_by')->unsigned();

            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tp_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tp_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('tp_timeline_project');
    }
}
