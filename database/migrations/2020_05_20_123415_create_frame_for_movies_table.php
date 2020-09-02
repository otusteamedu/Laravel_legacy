<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrameForMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_for_movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('Название фильма');
            $table->string('image')->comment('Кадр из фильма');
            $table->bigInteger('film_id')->unsigned()->nullable()->comment('id фильма');
            $table->timestamps();
        });

        Schema::table('frame_for_movies', function (Blueprint $table) {
            $table->foreign('film_id')->references('id')->on('films');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('frame_for_movies', function (Blueprint $table) {
            $table->dropForeign('film_id');
        });

        Schema::dropIfExists('frame_for_movies');

    }
}
