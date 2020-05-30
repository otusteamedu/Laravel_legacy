<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('color_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('color_id');
            $table->string('locale');
            $table->string('attribute');
            $table->string('value');
            $table->timestamps();
        });

        Schema::table('color_translations', function (Blueprint $table) {
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
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
        Schema::dropIfExists('color_translations');
    }
}
