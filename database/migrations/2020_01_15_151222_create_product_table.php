<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
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
            $table->unsignedBigInteger('created_user_id')->nullable();
            $table->string('name')->nullable(false);
            $table->string('title')->nullable();
            $table->string('h1')->nullable();
            $table->string('description')->nullable();
            $table->integer('price');
            $table->string('sku')->nullable()->unique();
            $table->timestamps();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('category_products')->onDelete('cascade');
            $table->foreign('created_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
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
