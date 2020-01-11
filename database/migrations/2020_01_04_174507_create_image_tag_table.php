<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_tag', function (Blueprint $table) {
            $table->bigInteger('tag_id')->unsigned();
            $table->bigInteger('image_id')->unsigned();
        });

        Schema::table('image_tag', function (Blueprint $table) {
            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('image_id')->references('id')->on('images')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['tag_id', 'image_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_tag');
    }
}
