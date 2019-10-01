<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user')->unsigned();
            $table->bigInteger('status')->unsigned();
            $table->timestamps();
        });

        Schema::table('journals', function (Blueprint $table) {
            $table
                ->foreign('user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('journals', function (Blueprint $table) {
            $table
                ->foreign('status')
                ->references('id')
                ->on('handbooks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journals');
    }
}
