<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable(false);
            $table->bigInteger('category')->unsigned()->nullable(false);
            $table->bigInteger('authors')->unsigned()->nullable(false);
            $table->bigInteger('status')->unsigned()->nullable(false);
            $table->string('file')->nullable(false);
            $table->year('year_publishing')->nullable();
            $table->timestamps();
        });

        Schema::table('materials', function (Blueprint $table) {
           $table->foreign('category')
               ->references('id')
               ->on('categories')
               ->onDelete('cascade');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->foreign('authors')
                ->references('id')
                ->on('authors')
                ->onDelete('cascade');
        });

        Schema::table('materials', function (Blueprint $table) {
            $table->foreign('status')
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
    public function down()
    {
        Schema::dropIfExists('materials');
    }
}
