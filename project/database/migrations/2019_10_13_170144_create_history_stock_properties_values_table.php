<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryStockPropertiesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_stock_properties_values', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->year('year');
            $table->tinyInteger('quarter');//only 1,2,3,4
            $table->integer('stock_property_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_stock_properties_values');
    }
}
