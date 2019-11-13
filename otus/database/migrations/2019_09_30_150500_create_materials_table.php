<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            $table->string('file');
            $table->string('preview_image');
            $table->string('type');
            $table->string('format');
            $table->year('year_publishing')->nullable();
            $table->timestamps();
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');


            $table->foreign('status_id')
                ->references('id')
                ->on('handbooks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('materials');
    }
}
