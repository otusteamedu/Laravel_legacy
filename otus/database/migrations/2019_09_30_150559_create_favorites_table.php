<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user')->unsigned()->nullable(false);
            $table->bigInteger('material')->unsigned()->nullable(false);
            $table->timestamps();
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('material')
                ->references('id')
                ->on('materials')
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
        Schema::dropIfExists('favorites');
    }
}
