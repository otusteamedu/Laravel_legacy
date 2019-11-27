<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->date('birth_day')->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->bigInteger('photo_id')->unsigned()->nullable();
            $table->text('description')->nullable();

            // $table->timestamps();
        });

        Schema::table('people', function (Blueprint $table) {
            $table->foreign('photo_id')
                ->references('id')->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
