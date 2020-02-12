<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->longText('text');
            $table->string('meta_title', 255);
            $table->text('meta_description');
            $table->string('url', 255);
            $table->bigInteger('file_id')->nullable();
            $table->timestamps();

/*             $table->foreign('file_id')
                    ->references('id')
                    ->on('files')
                    ->onDelete('cascade'); */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
}
