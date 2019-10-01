<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReadMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('read_materials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user')->unsigned()->nullable(false);
            $table->bigInteger('material')->unsigned()->nullable(false);
            $table->timestamps();
        });

        Schema::table('read_materials', function (Blueprint $table) {
            $table->foreign('user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::table('read_materials', function (Blueprint $table) {
            $table->foreign('material')
                ->references('id')
                ->on('materials')
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
        Schema::dropIfExists('read_materials');
    }
}
