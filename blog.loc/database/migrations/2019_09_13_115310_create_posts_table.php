<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->default('published');
            $table->string('slug', 500)->unique();
            $table->text('image')->nullable();
            $table->text('title')->nullable();
            $table->text('short_text')->nullable();
            $table->text('text')->nullable();
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->text('canonical_url')->nullable();
            $table->json('meta_tags')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
