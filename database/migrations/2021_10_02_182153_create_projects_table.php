<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_projects', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('p_id')->unsigned()->index();

            $table->string('p_name');
            $table->string('p_acronym');
            $table->longText('p_description');
            $table->datetime('p_submitted_at');
            $table->date('p_deadline');
            $table->date('p_end_date');
            $table->double('p_budget');
            $table->double('p_general_budget');
            $table->enum('p_state', ['Aprovado','Cancelado', 'Rejeitado' ,'Submetido','Sem resposta'])
            ->nullable()
            ->default('Submetido');

            $table->string('p_support_document')->nullable();
            $table->string('p_web_url')->nullable();
            $table->string('p_source')->nullable();
            
            $table->enum('p_currency', ['MZM','ZAR','EUR','USD'])->nullable()->default('MZM');
            $table->enum('p_consortium', ['sim','nao'])->nullable()->default('nao');

            $table->bigInteger('psm_id')->unsigned();
            $table->bigInteger('sa_id')->unsigned();
            $table->bigInteger('u_id')->unsigned();
            $table->bigInteger('p_updated_by')->unsigned();

            $table->foreign('u_id')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sa_id')->references('sa_id')->on('sa_search_area')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('p_updated_by')->references('u_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('psm_id')->references('psm_id')->on('psm_project_stage_micro')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('p_projects');
    }
}
