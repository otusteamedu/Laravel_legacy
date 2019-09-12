<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * реестр выставленых счетов
         */
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id')->comment('услуга по которой выставили счет');
            $table->unsignedBigInteger('address_id')->comment('л/с выставления счета');
            $table->decimal('amount', 12, 2)->comment('сумма выставленного счета');
            $table->string('status')->comment('статус оплаты счета выставлен/частично оплачен/оплачен полностью');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('service_id')->references('id')
                ->on('services')->onDelete('cascade');

            $table->foreign('address_id')->references('id')
                ->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
