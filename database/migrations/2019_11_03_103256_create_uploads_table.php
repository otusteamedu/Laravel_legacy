<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('file_id')->unsigned()->nullable();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->integer('sort')->unsigned()->default(0);

            $table->string('session_id', 40);
            $table->string('url', 255);
            $table->string('field', 255);
            $table->string('description', 255)->nullable();

            $table->timestamps();
        });

        Schema::table('uploads', function (Blueprint $table) {
            $table->foreign('file_id')
                ->references('id')
                ->on('files');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
