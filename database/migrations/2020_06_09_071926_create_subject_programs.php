<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectPrograms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->jsonb('meta')->nullable();
            $table->integer('sort')->default(0);
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('lesson_type_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('subject_programs', function (Blueprint $table) {
            $table->unique(['title', 'subject_id', 'user_id', 'lesson_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_programs');
    }
}
