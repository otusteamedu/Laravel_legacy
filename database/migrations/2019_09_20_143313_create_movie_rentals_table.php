<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_rentals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('movie_id')->unsigned();
            $table->bigInteger('cinema_id')->unsigned();
            $table->bigInteger('created_user_id')->unsigned();
            $table->dateTime('date_start_at')->nullable();
            $table->dateTime('date_end_at')->nullable();
            // $table->timestamps();
        });

        Schema::table('movie_rentals', function (Blueprint $table) {
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies');
            $table->foreign('cinema_id')
                ->references('id')
                ->on('cinemas');
            $table->foreign('created_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_rentals');
    }
}
