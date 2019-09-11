<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRateRegionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rate_region', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('rate_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('rate_region', function (Blueprint $table) {
            $table->foreign('rate_id')
                ->references('id')
                ->on('rates');

            $table->foreign('region_id')
                ->references('id')
                ->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rate_region');
    }
}
