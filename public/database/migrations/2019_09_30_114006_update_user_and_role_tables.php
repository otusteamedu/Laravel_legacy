<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserAndRoleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->string('slug')->unique();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roles', function(Blueprint $table){
            $table->dropColumn(array('slug'));
        });
        Schema::table('users', function(Blueprint $table){
            $table->dropColumn(array('phone'));
        });
    }
}
