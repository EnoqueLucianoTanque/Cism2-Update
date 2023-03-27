<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_recipients', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('r_id')->unsigned()->index();
            $table->string('r_name');
            $table->integer('r_state')->default(1);
            $table->bigInteger('r_updated_by')->unsigned();
            $table->bigInteger('r_created_by')->unsigned();

            $table->foreign('r_created_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('r_updated_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('r_recipients');
    }
}
