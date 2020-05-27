<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Фио актера');
            $table->string('slug')->comment('Фио актера транслитом для чпу');
            $table->string('description')->comment('описание актера')->nullable();
            $table->string('image')->comment('Путь до фото актера на сервере');
            $table->bigInteger('film_id')->unsigned()->nullable()->comment('id фильма');
            $table->timestamps();
        });

        Schema::table('actors', function (Blueprint $table) {
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
        Schema::table('actors', function (Blueprint $table) {
            $table->dropForeign('film_id');
        });

        Schema::dropIfExists('actors');
    }
}
