<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomOccupations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_occupations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('room_id')->constrained();
            $table->foreignId('schedule_id')->constrained();
            $table->bigInteger('occupationable_id');
            $table->string('occupationable_type');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('room_occupations', function (Blueprint $table) {
            $table->unique(['date', 'room_id', 'schedule_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_occupations');
    }
}
