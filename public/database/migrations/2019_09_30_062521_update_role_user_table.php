<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->on('roles')->references('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->on('users')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('reasons', function(Blueprint $table)
        {
            $table->dropForeign('role_id');
            $table->dropForeign('user_id');

            $table->dropColumn(array('role_id', 'user_id'));
        });
    }
}
