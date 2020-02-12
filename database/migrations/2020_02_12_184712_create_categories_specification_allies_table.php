<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesSpecificationAlliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories_specification_allies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('categories_id');
            $table->bigInteger('specification_id');
            $table->timestamps();

/*             $table->foreign('categories_id')
                ->references('id')
                ->on('catalog_categories')
                ->onDelete('cascade');

            $table->foreign('specification_id')
                    ->references('id')
                    ->on('catalog_specifications')
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
        Schema::dropIfExists('categories_specification_allies');
    }
}
