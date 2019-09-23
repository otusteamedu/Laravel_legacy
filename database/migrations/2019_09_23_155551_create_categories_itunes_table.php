<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesItunesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_itunes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
        });

        Schema::table('podcasts', function(Blueprint $table) {
            $table->unsignedBigInteger('category_itunes_id')->nullable()->default(null);
            $table->foreign('category_itunes_id')
                ->on('categories_itunes')
                ->references('id');
        });

        // Загрузим список официально рекомендуемых категорий от Apple для каталога iTunes
        $categories = file(__DIR__ . '/categories_itunes_data.txt');
        // Удалим случайные пробелвы в начале и конце строк
        $categories = array_map('trim', $categories);
        // Удалим пустые строки
        $categories = array_filter($categories);
        // Отсортируем по алфавиту
        sort($categories);

        $data = array_map(function($category) {
            return ['name' => $category];
        }, $categories);

        \DB::table('categories_itunes')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('podcasts', function(Blueprint $table) {
            $table->dropForeign('podcasts_category_itunes_id_foreign');
            $table->dropColumn('category_itunes_id');
        });

        Schema::dropIfExists('categories_itunes');

    }
}
