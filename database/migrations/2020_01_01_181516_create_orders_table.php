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
            $table->string('number', 50);
            $table->bigInteger('user_id')->unsigned();
            $table->smallInteger('price')->unsigned();
            $table->bigInteger('address_id')->unsigned();
            $table->bigInteger('delivery_id')->unsigned();
            $table->text('user_message')->nullable();
            $table->tinyInteger('status_id')->unsigned()->nullable();
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
