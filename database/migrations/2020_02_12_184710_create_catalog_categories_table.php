<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('parent_id')->default(0);
            $table->string('title', 255);
            $table->integer('visible')->default(0);
            $table->text('description');
            $table->string('meta_title', 255);
            $table->text('meta_description');
            $table->string('url', 255);
            $table->integer('order')->default(0);
            $table->bigInteger('file_id')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('file_id')
                    ->references('id')
                    ->on('files')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_categories');
    }
}
