<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('articles');

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->dateTime('published_at')->comment('Дата публикации')->nullable();
            $table->integer('state')->comment('Состояние');
            $table->integer('category_id')->comment('Идентификатор категории');
            $table->integer('user_id')->comment('Идентификатор пользователя добавившего статью')->nullable();
            ;$table->integer('hits')->comment('Количество просмотров')->nullable()->default(0);
            $table->string('title')->comment('Название');
            $table->text('image_intro')->comment('Изображение')->nullable();
            $table->text('intro_text')->comment('Вступительный текст')->nullable();
            $table->text('full_text')->comment('Полный текст')->nullable();
        });

        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->index('user_id');
            $table->index('category_id');
            $table->index('state');
            $table->index('published_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
