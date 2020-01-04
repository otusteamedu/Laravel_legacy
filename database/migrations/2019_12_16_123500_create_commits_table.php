<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('hash', 40)->index();
            $table->unsignedBigInteger('repository_id');
            $table->string('author');
            $table->dateTime('commit_datetime');
            $table->string('summary', 1000);
            $table->timestamps();

            $table->foreign('repository_id')
                ->on('repositories')
                ->references('id')
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
        Schema::dropIfExists('commits');
    }
}
