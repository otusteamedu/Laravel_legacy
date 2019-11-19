<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserCreateIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('grammars', function (Blueprint $table) {
            $table->unsignedBigInteger('create_user_id')->default('1');
        });
        Schema::table('grammars',function(Blueprint $table){
            $table->foreign('create_user_id')
                ->on('users')
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
        Schema::table('grammars', function (Blueprint $table) {
            //
        });
    }
}
