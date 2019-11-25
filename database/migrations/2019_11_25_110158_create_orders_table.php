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

            $table->bigInteger('buyer_id')->unsigned();
            $table->bigInteger('owner_id')->unsigned();

            $table->string('session_id', 40)->nullable();
            $table->string('number', 40)->nullable();
            $table->dateTime('ordered_at')->nullable();
            $table->integer('total')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();

            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('buyer_id')
                ->references('id')
                ->on('users');

            $table->foreign('owner_id')
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
        Schema::dropIfExists('orders');
    }
}
