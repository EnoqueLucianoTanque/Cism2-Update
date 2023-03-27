<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wt_web_type', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('wt_id')->unsigned()->index();
            $table->string('wt_name');
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
        Schema::dropIfExists('wt_web_type');
    }
}
