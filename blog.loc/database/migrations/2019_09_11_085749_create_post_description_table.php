<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostDescriptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_description', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');
            $table->string('lang', 5)->default('ru');
            $table->text('image')->nullable();
            $table->text('title')->nullable();
            $table->text('short_text')->nullable();
            $table->text('text')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('canonical_url')->nullable();
            $table->json('meta_tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_description');
    }
}
