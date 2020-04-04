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

            $table->string('name');

            $table->unsignedBigInteger('blog_author_id')->nullable();
            $table->foreign('blog_author_id')->references('id')->on('blog_authors')->onDelete('set null');

            $table->unsignedBigInteger('preview_picture_id')->nullable();
            $table->foreign('preview_picture_id')->references('id')->on('files')->onDelete('set null');

            $table->unsignedBigInteger('detail_picture_id')->nullable();
            $table->foreign('detail_picture_id')->references('id')->on('files')->onDelete('set null');

            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->foreign('updated_by_id')->references('id')->on('users')->onDelete('set null');

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
