<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_article', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('a_id')->unsigned()->index();
            $table->string('a_title');
            $table->string('a_link');
            $table->date('a_start_date');
            $table->bigInteger('p_id')->unsigned()->nullable();
            $table->bigInteger('sa_id')->unsigned();
            $table->enum('a_article', [1, 0])->nullable()->default(1);
            $table->bigInteger('a_created_by')->unsigned();
            $table->bigInteger('a_updated_by')->unsigned();
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sa_id')->references('sa_id')->on('sa_search_area')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('a_created_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('a_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('a_article');
    }
}
