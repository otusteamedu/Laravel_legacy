<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ar_word');
            $table->string('ar_word_mn');
            $table->string('rus_word');
            $table->string('rus_word_mn');
            $table->enum('word_type', ['ism', 'figl', 'harf']);
            $table->enum('fig_simpol', ['A', 'I', 'U']);
            $table->unsignedBigInteger('lessen_id');
        });

        Schema::table('words',function(Blueprint $table){
            $table->foreign('lessen_id')
                ->on('grammars')
                ->references('id')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
}
