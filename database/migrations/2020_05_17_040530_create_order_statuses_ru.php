<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderStatusesRu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses_ru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_status_id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        Schema::table('order_statuses_ru', function (Blueprint $table) {
            $table->foreign('order_status_id')
                ->references('id')
                ->on('order_statuses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses_ru');
    }
}
