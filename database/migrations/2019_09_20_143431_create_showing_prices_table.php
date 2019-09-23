<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShowingPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showing_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('movie_showing_id')->unsigned();
            $table->bigInteger('tariff_id')->unsigned();
            $table->integer('value')->unsigned()->default(0);

            $table->timestamps();
        });

        Schema::table('showing_prices', function (Blueprint $table) {
            $table->foreign('movie_showing_id')
                ->references('id')
                ->on('movie_showings')
                ->onDelete('cascade');
            $table->foreign('tariff_id')
                ->references('id')
                ->on('tariffs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showing_prices');
    }
}
