<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('название жанра')->nullable();
            $table->string('slug')->comment('название фильма транслитом для ЧПУ')->nullable();
            $table->bigInteger('film_id')->unsigned()->nullable()->comment('id фильма');
            $table->timestamps();
        });

        Schema::table('genres', function (Blueprint $table) {
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

        Schema::table('genres', function (Blueprint $table) {
            $table->dropForeign('film_id');
        });

        Schema::dropIfExists('genres');
    }
}
