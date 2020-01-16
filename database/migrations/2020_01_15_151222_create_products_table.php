<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('category_id')->unsigned();
            $table->string('name')->nullable(false);
            $table->string('title')->nullable();
            $table->string('h1')->nullable();
            $table->string('description')->nullable();
            $table->integer('price');
            $table->string('sku')->nullable()->unique();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories_products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
