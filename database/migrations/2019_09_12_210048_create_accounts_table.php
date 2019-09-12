<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * счета начисления и списания денежных средств предприятия
         */
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('Именнование счета/начисления');
            $table->decimal('amount', 12, 2)->comment('баланс счета приход - расходы');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
