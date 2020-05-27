<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryGroupTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_group_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_group_id');
            $table->string('attribute');
            $table->string('value');
            $table->timestamps();
        });

        Schema::table('category_group_translations', function (Blueprint $table) {
            $table->foreign('category_group_id')
                ->references('id')
                ->on('category_groups')
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
        Schema::dropIfExists('category_group_translations');
    }
}
