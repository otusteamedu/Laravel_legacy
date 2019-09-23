<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCinemaPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cinema_photos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cinema_id');
            $table->unsignedBigInteger('photo_id');
            $table->timestamps();
        });

        Schema::table('cinema_photos', function (Blueprint $table) {
            $table->foreign('cinema_id')
                ->references('id')
                ->on('cinemas')
                ->onDelete('cascade');
            $table->foreign('photo_id')
                ->references('id')
                ->on('files')
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
        Schema::dropIfExists('cinema_photos');
    }
}
