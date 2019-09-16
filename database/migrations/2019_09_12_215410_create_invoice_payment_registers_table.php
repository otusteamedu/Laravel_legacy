<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicePaymentRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Реестр оплаты счетов
         */
        Schema::create('invoice_payment_registers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id')->comment('ссылка на счет');
            $table->decimal('amount', 12, 2)->comment('сумма оплаты по счету');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('invoice_payment_registers', function (Blueprint $table) {
            $table->foreign('invoice_id')->references('id')
                ->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_payment_registers');
    }
}
