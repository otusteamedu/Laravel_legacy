<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    const TABLE = 'prices';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contract_id');
            $table->unsignedFloat('price')->default(0);
            $table->unsignedFloat('price_fix')->default(0);
            $table->timestamps();
            $table->time('stoped_at')->nullable();
        });

        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->foreign('contract_id')->references('id')->on('contracts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
