<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->text('description');
            $table->integer('categorie_parent_id');
            $table->bigInteger('files_id')->nullable();
            $table->string('meta_title', 255);
            $table->text('meta_description');
            $table->string('url', 255);
            $table->integer('order')->default(0);
            
            $table->softDeletes();
            $table->timestamps();

/*             $table->foreign('categorie_parent_id')
                    ->references('id')
                    ->on('catalog_categories')
                    ->onDelete('cascade'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_items');
    }
}
