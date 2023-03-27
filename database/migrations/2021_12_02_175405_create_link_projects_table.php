<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lp_link_projects', function (Blueprint $table) {
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('lp_id')->unsigned()->index();
            $table->bigInteger('p_id')->unsigned();
            $table->bigInteger('lp_created_by')->unsigned();
            $table->bigInteger('lp_updated_by')->unsigned();
            $table->string('lp_name');
            $table->string('lp_link');
            $table->date('lp_submitted_at');
            $table->string('lp_magazine_name');
            // $table->longText('description')->nullable()->default('text');
            $table->longText('lp_details')->nullable();
            $table->enum('lp_state', [1,0])->default(1);
            $table->foreign('lp_created_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('lp_updated_by')->references('u_id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('p_id')->references('p_id')->on('p_projects')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('lp_link_projects');
    }
}
