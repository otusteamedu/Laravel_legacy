<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_user', function (Blueprint $table) {
            $table->integer('agreement_id');
            $table->integer('user_id');
            $table->boolean("is_owner");
            $table->set("status", ["sent", "agree", "reject"]);
            $table->string("rejected_reason", "255")->nullable();
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
        Schema::dropIfExists('agreement_user');
    }
}
