<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    protected const TABLE = 'pages';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID');
            $table->string('name')->comment('Наззвание страницы');
            $table->text('content')->nullable()->comment('Содержание');
            $table->string('slug')->unique()->comment('Адрес');
            $table->string('title')->nullable()->comment('Заголовок страницы');
            $table->string('keywords')->nullable()->comment('Meta Keywords');
            $table->string('description')->nullable()->comment('Meta Description');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
