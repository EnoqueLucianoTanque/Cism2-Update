<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('st_sub_task', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('st_id')->unsigned()->index();
            $table->string('st_name');
            $table->text('st_description');
            $table->date('st_start_date')->nullable();
            $table->date('st_final_date')->nullable();
            $table->date('st_due_date')->nullable();
            $table->bigInteger('t_id')->unsigned();
            $table->bigInteger('st_state')->unsigned();
            $table->bigInteger('st_created_by')->unsigned();
            $table->bigInteger('st_updated_by')->unsigned();
            $table->foreign('t_id')->references('t_id')->on('t_task')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('st_state')->references('c_id')->on('c_config')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('st_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('st_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('st_sub_task');
    }
}
