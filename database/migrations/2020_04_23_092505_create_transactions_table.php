<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('reason_id');
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('reason_id')->references('id')->on('reasons');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropForeign('student_id');
            $table->dropForeign('user_id');
            $table->dropForeign('reason_id');
        });


        Schema::dropIfExists('transactions');
    }
}
