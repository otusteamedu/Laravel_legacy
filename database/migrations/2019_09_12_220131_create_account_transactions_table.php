<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * реестр транзакций по счету
         */
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('counterparty_id')->nullable();
            $table->string('comment');
            $table->decimal('amount', 12, 2)
                ->comment('сумма транзакции, может быть как положителная так и отрицательная');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('account_transactions', function (Blueprint $table) {
            $table->foreign('account_id')->references('id')
                ->on('accounts')->onDelete('cascade');

            $table->foreign('counterparty_id')->references('id')
                ->on('counterparties')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_transactions');
    }
}
