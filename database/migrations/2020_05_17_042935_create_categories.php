<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Mockery\Generator\StringManipulation\Pass\Pass;

class CreateCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_ru');
            $table->unsignedBigInteger('group_id');
            $table->unsignedInteger('position');
            $table->timestamps();
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('group_id')
                ->references('id')
                ->on('category_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
