<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCounterpartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * контрагенты
         */
        Schema::create('counterparties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('наименование контрагента');
            $table->string('comment')->comment('доплнительная информация');

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
        Schema::dropIfExists('counterparties');
    }
}
