<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('Название фильма');
            $table->string('meta_title')->comment('Название фильма для поисковой системы')->nullable();
            $table->string('meta_description')->comment('Описание для поисковой системы')->nullable();
            $table->string('keywords')->comment('Ключевые слова для поисковой системы')->nullable();
            $table->string('slug')->comment('Название фильма транслитом для ЧПУ');
            $table->string('status')->comment('Опубликовано или нет');
            $table->text('content')->comment('Описание фильма')->nullable();
            $table->string('year')->comment('Год фильма');
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
        Schema::dropIfExists('films');

    }
}
