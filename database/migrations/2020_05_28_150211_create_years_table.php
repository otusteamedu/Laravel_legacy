<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYearsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('years', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('наименование года')->nullable();
            $table->string('slug')->comment('название года транслитом для ЧПУ')->nullable();
            $table->bigInteger('film_id')->unsigned()->nullable()->comment('id фильма');
            $table->timestamps();
        });

        Schema::table('years', function (Blueprint $table) {
            $table->foreign('film_id')->references('id')->on('films');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('years', function (Blueprint $table) {
            $table->dropForeign('film_id');
        });
        
        Schema::dropIfExists('years');
    }
}
