<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('payment_id')->primary();

            $table->bigInteger('order_id')->unsigned();
            $table->enum('stage', ['new', 'input', 'check', 'done'])->default('new');
            $table->string('message', 255)->nullable();
            $table->boolean('is_error')->default(false);
            $table->json('payment_data')->nullable();
            $table->integer('total')->nullable()->unsigned();

            $table->timestamps();
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
