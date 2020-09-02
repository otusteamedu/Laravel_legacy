<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_genre', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('film_id')->unsigned()->nullable()->comment('id фильма');
            $table->bigInteger('genre_id')->unsigned()->nullable()->comment('id жанра');
            $table->timestamps();
        });


        Schema::table('film_genre', function (Blueprint $table) {
            $table->foreign('film_id')->references('id')->on('films');
        });

        Schema::table('film_genre', function (Blueprint $table) {
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('film_genre', function (Blueprint $table) {
            $table->foreign('film_id')->references('id')->on('films');
        });

        Schema::table('film_genre', function (Blueprint $table) {
            $table->foreign('genre_id')->references('id')->on('genres');
        });

        Schema::dropIfExists('film_genre');
    }
}
