<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /** @var string  */
    protected const TABLE = 'posts';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID новости');
            $table->string('name')->comment('Заголовок новости');
            $table->string('image')->nullable()->comment('Изображение');
            $table->text('content')->nullable()->comment('Содержание');
            $table->string('link')->nullable()->comment('Ссылка');
            $table->string('slug')->unique()->comment('Адрес');
            $table->string('title')->nullable()->comment('Заголовок страницы');
            $table->string('keywords')->nullable()->comment('Meta Keywords');
            $table->string('description')->nullable()->comment('Meta Description');
            $table->unsignedInteger('user_id')->nullable(false)->comment('ID пользователя');
            $table->timestamp('published_at')->nullable()->default(null)->comment('Дата опубликавания');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down():void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
