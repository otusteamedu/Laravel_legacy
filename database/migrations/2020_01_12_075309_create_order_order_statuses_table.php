<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_order_status', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedInteger('status_id');
            $table->timestamps();
        });

        Schema::table('order_order_status', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('status_id')->references('id')->on('order_statuses')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['order_id', 'status_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_order_status');
    }
}
