<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('room_id')->constrained();
            $table->foreignId('education_plan_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->unique(['date', 'room_id', 'education_plan_id', 'schedule_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lessons');
    }
}
