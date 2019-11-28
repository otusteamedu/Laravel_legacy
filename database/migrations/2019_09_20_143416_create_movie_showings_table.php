<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieShowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_showings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('movie_rental_id')->unsigned();
            $table->bigInteger('hall_id')->unsigned();
            $table->dateTime('datetime');

            // $table->timestamps();
        });

        Schema::table('movie_showings', function (Blueprint $table) {
            $table->foreign('movie_rental_id')
                ->references('id')
                ->on('movie_rentals');
            $table->foreign('hall_id')
                ->references('id')
                ->on('halls');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_showings');
    }
}
