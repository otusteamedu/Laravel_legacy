<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('style_id')->unsigned();
            $table->foreign('style_id')->references('style_id')->on('styles')->onDelete('cascade');

            $table->integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('instructor_id')->on('instructors')->onDelete('cascade');
            $table->string('days', 100);
            $table->string('time', 25);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
