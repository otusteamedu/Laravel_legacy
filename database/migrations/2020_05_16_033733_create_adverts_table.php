<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('town_id')->unsigned();
            $table->bigInteger('division_id')->unsigned();
            $table->string('title', 255);
            $table->string('img', 255);
            $table->text('content');
            $table->timestamps();
        });

        Schema::table('adverts', function (Blueprint $table){
           $table->foreign('user_id')
                 ->references('id')
                 ->on('users')
                 ->onDelete('cascade');
        });

        Schema::table('adverts', function (Blueprint $table){
            $table->foreign('town_id')
                ->references('id')
                ->on('towns')
                ->onDelete('cascade');
        });

        Schema::table('adverts', function (Blueprint $table){
            $table->foreign('division_id')
                ->references('id')
                ->on('divisions')
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
        Schema::dropIfExists('adverts');
    }
}
