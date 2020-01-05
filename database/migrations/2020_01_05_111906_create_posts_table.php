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
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID новости');
            $table->string('name')->comment('Заголовок новости');
            $table->string('image')->comment('Изображение');
            $table->text('content')->comment('Содержание');
            $table->string('link')->comment('Ссылка');
            $table->string('slug')->unique()->comment('Адрес');
            $table->string('title')->comment('Заголовок страницы');
            $table->string('keywords')->comment('Meta Keywords');
            $table->string('description')->comment('Meta Description');
            $table->unsignedInteger('user_id')->nullable(false)->comment('ID пользователя');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
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
