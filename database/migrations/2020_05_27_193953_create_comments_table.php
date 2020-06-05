<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('comment')->comment('комментарий')->nullable();
            $table->bigInteger('film_id')->unsigned()->nullable()->comment('id фильма');
            $table->bigInteger('user_id')->unsigned()->nullable()->comment('id пользователя');
            $table->timestamps();
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('film_id')->references('id')->on('films');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('film_id')->references('id')->on('films');
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('films');
        });


        Schema::dropIfExists('comments');
    }
}
