<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEducationPlans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('education_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('hours')->default(0);
            $table->foreignId('subject_id')->constrained();
            $table->foreignId('group_id')->constrained();
            $table->foreignId('user_id')->nullable()->constrained();
            $table->foreignId('lesson_type_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('education_plans', function (Blueprint $table) {
            $table->unique(['subject_id', 'group_id', 'user_id', 'lesson_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('education_plans');
    }
}
