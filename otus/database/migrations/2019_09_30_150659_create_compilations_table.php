<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompilationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compilations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('material')->unsigned();
            $table->bigInteger('compilation')->unsigned();
            $table->timestamps();
        });

        Schema::table('compilations', function (Blueprint $table) {
            $table->foreign('material')
                ->references('id')
                ->on('materials')
                ->onDelete('cascade');
        });

        Schema::table('compilations', function (Blueprint $table) {
            $table->foreign('compilation')
                ->references('id')
                ->on('selection_materials')
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
        Schema::dropIfExists('compilations');
    }
}
