<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostReceiver extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_receiver', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained();
            $table->string('receiver_model');
            $table->bigInteger('receiver_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('post_receiver', function (Blueprint $table) {
            $table->unique(['post_id', 'receiver_model', 'receiver_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_receiver');
    }
}
