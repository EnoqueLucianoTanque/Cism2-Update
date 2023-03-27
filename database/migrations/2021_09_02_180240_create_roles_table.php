<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_roles', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('r_id')->unsigned()->index();
            $table->string("r_name");
            $table->text("r_description");
            $table->dateTime('r_start_date');
            // $table->bigInteger('r_created_by')->unsigned();
            // $table->bigInteger('r_updated_by')->unsigned();
            // $table->foreign('r_created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('r_updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('r_roles');
    }
}
