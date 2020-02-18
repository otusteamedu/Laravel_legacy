<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgreementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("title", 255);
            $table->text("description")->nullable();
            $table->integer("version")->default(1);
            $table->string("status"); // ["active", "new", "old"]
            $table->bigInteger("version_owner_user_id");
            $table->foreign('version_owner_user_id')->references('id')->on('users');
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
        Schema::dropIfExists('agreement');
    }
}
