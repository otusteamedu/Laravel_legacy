<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('path');
            $table->string('mime_type');
            $table->integer('size');
            $table->integer('width')->default(0);
            $table->integer('height')->default(0);
            $table->string('file_type')->default(\App\Models\File::FILE_TYPE);
            $table->integer('usage')->default(\App\Models\File::USAGE);

            $table->unsignedBigInteger('source_id')->nullable();
            $table->foreign('source_id')->references('id')->on('files')->onDelete('set null');

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
