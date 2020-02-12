<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('text');

            $table->unsignedBigInteger('blog_author_id')->nullable();
            $table->foreign('blog_author_id')->references('id')->on('blog_authors')->onDelete('set null');

            $table->unsignedBigInteger('preview_picture')->nullable();
            $table->foreign('preview_picture')->references('id')->on('pictures')->onDelete('set null');

            $table->unsignedBigInteger('detail_picture')->nullable();
            $table->foreign('detail_picture')->references('id')->on('pictures')->onDelete('set null');

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
        Schema::dropIfExists('blog_articles');
    }
}
