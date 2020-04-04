<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            $table->bigInteger('parent_id')->nullable()->unsigned();
            $table->foreign('parent_id')->references('id')->on('blog_categories')->onDelete('set null');

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
        Schema::dropIfExists('blog_categories');
    }
}
