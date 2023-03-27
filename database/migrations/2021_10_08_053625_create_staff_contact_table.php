<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sc_staff_contact', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('sc_id')->unsigned()->index();
            //$table->bigInteger('sc_created_by')->unsigned();
            $table->string('sc_contact');
            $table->bigInteger('u_id')->unsigned();
            $table->bigInteger('sc_updated_by')->unsigned();

            $table->foreign('u_id')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sc_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('sc_staff_contact');
    }
}
