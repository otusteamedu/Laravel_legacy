<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModPermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mod_perms', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('access_id')->unsigned();
        });

        Schema::table('mod_perms', function (Blueprint $table) {
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');

            $table->foreign('access_id')
                ->references('id')
                ->on('mod_accesses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mod_perms');
    }
}
