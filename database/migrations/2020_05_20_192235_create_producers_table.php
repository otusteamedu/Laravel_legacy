<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Фио режиссера');
            $table->string('slug')->comment('Фио режиссера транслитом для чпу');
            $table->string('description')->comment('описание режиссера')->nullable();
            $table->string('image')->comment('Путь до фото режиссера на сервере')->nullable();
            $table->timestamps();
        });

        Schema::table('films', function (Blueprint $table) {
            $table->foreign('producer_id')->references('id')->on('producers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropForeign('producer_id');
        });

        Schema::dropIfExists('producers');
    }
}
