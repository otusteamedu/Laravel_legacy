<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("comment")->nullable();
            $table->string("status"); // ["new", "confirmed", "rejected"]
            $table->date("penalty_date");
            $table->bigInteger("penalty_id");
            $table->bigInteger("declare_user_id")->comment("Пользователь, отправивший запрос на создание штрафа");
            $table->bigInteger("penalty_user_id")->comment("Проштрафившийся пользователь");
            $table->bigInteger("agreement_id");
            $table->foreign('agreement_id')
                ->references('id')
                ->on('agreements')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal');
    }
}
