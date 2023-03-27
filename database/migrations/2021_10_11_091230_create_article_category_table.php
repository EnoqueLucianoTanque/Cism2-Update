<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ac_article_category', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('ac_id')->unsigned()->index();
            $table->string('ac_description');

            $table->bigInteger('ac_created_by')->unsigned();
            $table->bigInteger('ac_updated_by')->unsigned();

            $table->foreign('ac_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ac_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('ac_article_category');
    }
}
