<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->comment('Url запроса');;
            $table->string('method')->comment('Метод отправки запроса');
            $table->string('params')->nullable()->comment('Параметры запроса');
            $table->integer('status')->comment('Статус ответа');
            $table->float('duration')->comment('Время выполения запроса в сек.');
            $table->string('ip')->comment('IP с которого был отправлен запрос');
            $table->string('agent')->nullable()->comment('Информация о браузере');
            $table->integer('user_id')->nullable()->index()->comment('Пользователь');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activity_log');
    }
}
