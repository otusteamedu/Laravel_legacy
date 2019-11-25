<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('hall_id')->unsigned()->nullable();
            $table->bigInteger('tariff_id')->unsigned()->nullable();
            $table->bigInteger('row_number')->unsigned();
            $table->bigInteger('place_number')->unsigned();

            // $table->timestamps();
        });

        Schema::table('places', function (Blueprint $table) {
            $table->unique(['hall_id', 'row_number', 'place_number']);
        });

        Schema::table('places', function (Blueprint $table) {
            $table->foreign('hall_id')
                ->references('id')
                ->on('halls');
            $table->foreign('tariff_id')
                ->references('id')
                ->on('tariffs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
