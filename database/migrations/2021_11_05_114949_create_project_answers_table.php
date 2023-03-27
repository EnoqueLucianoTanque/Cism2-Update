<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pa_project_answers', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('pa_id')->unsigned()->index();
            $table->bigInteger('pq_id')->unsigned();
            $table->bigInteger('p_id')->unsigned();
            $table->enum('pa_answer', ['Sim', 'Não', 'Sem resposta'])->nullable()->default('Sem resposta');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pq_id')->references('pq_id')->on('pq_project_questions')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pa_project_answers');
    }
}
