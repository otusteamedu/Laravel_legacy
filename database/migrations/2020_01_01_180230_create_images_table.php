<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('path', 100);
            $table->string('extension', 4);
            $table->string('mime', 11);
            $table->smallInteger('width')->unsigned();
            $table->smallInteger('height')->unsigned();
            $table->unsignedInteger('format_id')->nullable();
            $table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('views')->default(0);
            $table->tinyInteger('publish')->unsigned()->default(1 );
            $table->text('description')->nullable();
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
        Schema::dropIfExists('images');
    }
}
