<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->bigInteger('producer_id')->unsigned()->nullable();
            $table->date('premiereDate')->nullable();
            $table->text('slogan')->nullable();
            $table->longText('description')->nullable();
            $table->integer('duration')->unsigned()->nullable();
            $table->enum('age_limit', ['0', '6', '12', '16', '18'])->nullable();
            $table->bigInteger('poster_id')->unsigned()->nullable();
            $table->string('trailer_link', 100)->nullable();

            $table->bigInteger('created_user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('movies', function (Blueprint $table) {
            $table->foreign('poster_id')
                ->references('id')
                ->on('files');

            $table->foreign('producer_id')
                ->references('id')
                ->on('people');

            $table->foreign('created_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
