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

            $table->bigInteger('buyer_id')->unsigned()->nullable();
            $table->bigInteger('owner_id')->unsigned()->nullable();
            $table->uuid('payment_id')->unsigned()->nullable();

            $table->string('session_id', 40)->nullable();
            $table->string('number', 40)->nullable();
            $table->dateTime('ordered_at')->nullable();
            $table->integer('count')->nullable()->unsigned();
            $table->integer('total')->nullable()->unsigned();
            $table->string('name', 255)->nullable();
            $table->string('phone', 255)->nullable();
            $table->string('email', 255)->nullable();
            $table->enum('status', ['cart', 'confirmed', 'canceled', 'done'])->default('cart');

            $table->timestamps();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('buyer_id')
                ->references('id')
                ->on('users');

            $table->foreign('owner_id')
                ->references('id')
                ->on('users');

            $table->foreign('payment_id')
                ->references('payment_id')
                ->on('payments');

            $table->index('session_id');
            $table->index('status');
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
