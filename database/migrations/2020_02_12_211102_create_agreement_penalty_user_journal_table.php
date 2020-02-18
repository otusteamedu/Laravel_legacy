<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementPenaltyUserJournalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_penalty_user_journal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text("comment")->nullable();
            $table->string("status"); // ["new", "confirmed", "rejected"]
            $table->date("penalty_date");
            $table->integer("agreement_penalty_id");
            $table->integer("declare_user_id")->comment("Пользователь, отправивший запрос на создание штрафа");
            $table->integer("penalty_user_id")->comment("Проштрафившийся пользователь");
            $table->integer("agreement_id");
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
        Schema::dropIfExists('agreement_penalty_user_journal');
    }
}
