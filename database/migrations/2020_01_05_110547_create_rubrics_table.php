<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRubricsTable extends Migration
{
    /** @var string  */
    protected const TABLE = 'rubrics';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id')->comment('ID рубрики');
            $table->string('name')->comment('Название рубрики');
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
