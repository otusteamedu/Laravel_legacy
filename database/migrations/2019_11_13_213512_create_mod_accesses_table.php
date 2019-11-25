<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mod_accesses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('module_id')->unsigned();
            $table->integer('sort')->unsigned()->default(0);
            $table->char('code', 1);
            $table->string('name', 100);
        });

        Schema::table('mod_accesses', function (Blueprint $table) {
            $table->foreign('module_id')
                ->references('id')
                ->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mod_accesses');
    }
}
