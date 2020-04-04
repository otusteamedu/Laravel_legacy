<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');

            $table->unsignedBigInteger('photo_id')->nullable();
            $table->foreign('photo_id')->references('id')->on('files')->onDelete('set null');

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
        Schema::dropIfExists('blog_authors');
    }
}
