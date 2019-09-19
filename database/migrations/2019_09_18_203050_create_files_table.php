<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('file_name', 255);
            $table->string('subdir', 10);
            $table->string('original_name', 255)->nullable();
            $table->string('content_type', 32);
            $table->integer('width')->default(0)->unsigned();
            $table->integer('height')->default(0)->unsigned();
            $table->integer('file_size')->default(0)->unsigned();

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
        Schema::dropIfExists('files');
    }
}
