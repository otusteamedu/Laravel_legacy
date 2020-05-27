<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsAndRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors_and_roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('role')->comment('Роль актера');
            $table->bigInteger('film_id')->unsigned()->nullable()->comment('id фильма');
            $table->bigInteger('actor_id')->unsigned()->nullable()->comment('id актера');
            //$table->bigInteger('actor_id')->unsigned()->nullable()->comment('Id актера'); //по нему достанем всю информацию об актере
           // $table->bigInteger('film_id')->unsigned()->nullable()->comment('Id фильма'); //по нему достанем всю информацию о фильме
            $table->timestamps();
        });
        Schema::table('actors_and_roles', function (Blueprint $table) {
            $table->foreign('film_id')->references('id')->on('films');
        });

        Schema::table('actors_and_roles', function (Blueprint $table) {
            $table->foreign('actor_id')->references('id')->on('actors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('actors_and_roles', function (Blueprint $table) {
            $table->dropForeign('film_id');
        });

        Schema::table('actors_and_roles', function (Blueprint $table) {
            $table->dropForeign('actor_id');
        });

        Schema::dropIfExists('actors_and_roles');
    }
}
