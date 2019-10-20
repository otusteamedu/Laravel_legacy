<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        /*
         * таблица с объектами начисления платежей
         */
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address')
                ->comment('адрес расположения объекта лицевого счета');
            $table->string('owner_name')
                ->comment('имя владельца');
            $table->string('number')->unique()
                ->comment('номер лицевого счета');
            $table->decimal('balance', 12, 2)
                ->comment('баланс лицевого счета оплачено - начисления, долгов нет = 0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
