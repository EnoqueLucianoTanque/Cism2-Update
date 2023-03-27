<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('row_id')->autoIncrement();
            $table->index(array("row_id"))->unsigned()->primary();
            $table->bigInteger('u_id')->unsigned()->index();
            $table->bigInteger('s_id')->unsigned();
            $table->bigInteger('r_id')->unsigned();
            $table->bigInteger('ui_id')->unsigned();
            $table->bigInteger('state');
            $table->integer('loginAttempt')->default(0);

            // $table->string('username');
            $table->string('email');
            $table->string('remember_token');
            $table->string('password');
            $table->dateTime('email_verified_at');

            $table->foreign('r_id')
            ->references('r_id')
            ->on('r_roles')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('s_id')->references('s_id')->on('s_staff')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ui_id')->references('ui_id')->on('ui_user_institution')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('users');
    }
}
