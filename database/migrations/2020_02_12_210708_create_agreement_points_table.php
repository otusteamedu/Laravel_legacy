<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer("number");
            $table->text("text");
            $table->integer('agreement_id');
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
        Schema::dropIfExists('agreement_points');
    }
}
