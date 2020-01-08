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
            $table->bigInteger('product_id')->unsigned();
            $table->string('product_class', 255);

            $table->integer('price')->nullable();
            $table->string('name', 255)->nullable();
            $table->json('description')->nullable();
            $table->boolean('available')->default(true);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');

            $table->index('available');
            $table->index(['product_id', 'product_class']);
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
