<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('responsibility_user');

        Schema::create('group_user', function (Blueprint $table) {
            $table->bigInteger('group_id');
            $table->bigInteger('user_id');
        });

        Schema::create('responsibility_user', function (Blueprint $table) {
            $table->bigInteger('responsibility_id');
            $table->bigInteger('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_user');
        Schema::dropIfExists('responsibility_user');
    }
}
