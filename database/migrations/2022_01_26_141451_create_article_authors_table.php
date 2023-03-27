<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aa_article_authors', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('aa_id')->unsigned()->index();
            $table->bigInteger('a_id')->nullable()->unsigned();
            $table->bigInteger('ca_id')->nullable()->unsigned();
            $table->foreign('ca_id')->references('ca_id')->on('ca_cism_authors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('a_id')->references('a_id')->on('a_article')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('aa_article_authors');
    }
}
