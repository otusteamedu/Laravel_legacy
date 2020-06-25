<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Название страницы')->nullable();
            $table->string('meta_title')->comment('Заголовок страницы для SEO')->nullable();
            $table->string('meta_keywords')->comment('Ключевые слова для SEO')->nullable();
            $table->string('meta_description')->comment('Описание для SEO')->nullable();
            $table->string('slug')->comment('Название страницы транслитом для ЧПУ')->nullable();
            $table->longText('content')->comment('Содержимое страницы')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
