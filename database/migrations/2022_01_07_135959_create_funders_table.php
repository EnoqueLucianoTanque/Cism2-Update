<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('f_funders', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('f_id')->unsigned()->index();
            $table->string('f_name');
            $table->enum('f_state',[1,0])->default(1);
            $table->bigInteger('f_created_by')->unsigned();
            $table->bigInteger('f_updated_by')->unsigned();
            $table->foreign('f_created_by')->references('u_id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->foreign('f_updated_by')->references('u_id')->on('users')->onDelete('no action')->onUpdate('no action');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('f_funders');
    }
}
