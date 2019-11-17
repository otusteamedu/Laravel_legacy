<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrthographyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orthography', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('name');
            $table->string('title');
            $table->string('code')->unique();
            $table->string('meta_keywords')->nullable()->default('Арабский язык');
            $table->string('meta_description')->nullable()->default('Арабский язык');
            $table->string('harf_name')->nullable();
            $table->string('harf_free')->nullable();
            $table->string('harf_first')->nullable();
            $table->string('harf_center')->nullable();
            $table->string('harf_last')->nullable();
            $table->string('harf_free_img')->nullable();
            $table->string('harf_first_img')->nullable();
            $table->string('harf_center_img')->nullable();
            $table->string('harf_last_img')->nullable();
            $table->string('harf_name_sound')->nullable();
            $table->string('harf_fatha_sound')->nullable();
            $table->string('harf_kesra_sound')->nullable();
            $table->string('harf_damma_sound')->nullable();
            $table->string('harf_saken_sound')->nullable();
            $table->string('img_tell')->nullable();
            $table->text('text_about')->nullable();
            $table->text('text_for_reading')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orthography');
    }
}
