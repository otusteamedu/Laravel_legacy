<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->smallInteger('price')->unsigned();
            $table->json('items');
            $table->json('delivery');
            $table->json('customer');
            $table->integer('status_id')->unsigned();
            $table->text('comment')->nullable();
            $table->timestamps();
        });

        Schema::table('orders', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
