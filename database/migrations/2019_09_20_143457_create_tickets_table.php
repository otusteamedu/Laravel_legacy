<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('movie_showing_id')->unsigned();
            $table->bigInteger('place_id')->unsigned()->nullable();
            $table->bigInteger('created_user_id')->unsigned()->nullable();
            $table->dateTime('created_at')->nullable();
            $table->bigInteger('released_user_id')->unsigned()->nullable();
            $table->dateTime('released_at')->nullable();
            //$table->timestamps();
        });

        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('movie_showing_id')
                ->references('id')
                ->on('movie_showings');
            $table->foreign('place_id')
                ->references('id')
                ->on('places');
            $table->foreign('created_user_id')
                ->references('id')
                ->on('users');
            $table->foreign('released_user_id')
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
        Schema::dropIfExists('tickets');
    }
}
