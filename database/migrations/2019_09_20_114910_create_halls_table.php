<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('cinema_id')->unsigned()->nullable();
            $table->string('name', 255);
            $table->integer('number')->unsigned();
            // $table->timestamps();
        });

        Schema::table('halls', function (Blueprint $table) {
            $table->unique(['cinema_id', 'number']);
        });

        Schema::table('halls', function (Blueprint $table) {
            $table->foreign('cinema_id')
                ->references('id')->on('cinemas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls');
    }
}
