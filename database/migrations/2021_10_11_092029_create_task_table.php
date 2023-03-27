<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_task', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('t_id')->unsigned()->index();
            $table->string('t_name');
            $table->string('t_atual_state');
            $table->text('t_description');
            $table->longText('t_preliminary_results');
            
            $table->text('t_objective');
            $table->date('t_start_date')->nullable();
            $table->date('t_final_date')->nullable();
            $table->date('t_due_date')->nullable();
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('t_state')->unsigned();
            $table->bigInteger('t_created_by')->unsigned();
            $table->bigInteger('t_updated_by')->unsigned();
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('t_state')->references('c_id')->on('c_config')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('t_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('t_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('t_task');
    }
}
