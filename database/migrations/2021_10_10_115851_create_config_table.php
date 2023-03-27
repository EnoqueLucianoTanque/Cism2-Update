<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_config', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('c_id')->unsigned()->index();
            $table->string("c_name");
            $table->string("c_value");
            $table->string("c_type");
            $table->text("c_description");
            $table->dateTime('c_start_date');
            $table->bigInteger('c_created_by')->unsigned();
            $table->bigInteger('c_updated_by')->unsigned();
            $table->foreign('c_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('c_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('c_config');
    }
}
