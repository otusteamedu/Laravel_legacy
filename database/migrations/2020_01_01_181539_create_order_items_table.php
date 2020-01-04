<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('image_id')->unsigned();
            $table->string('image_crop', 100);
            $table->integer('texture_id')->unsigned();
            $table->smallInteger('width')->unsigned();
            $table->smallInteger('height')->unsigned();
            $table->smallInteger('cost')->unsigned();
            $table->timestamps();
        });

        Schema::table('order_items', function(Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
