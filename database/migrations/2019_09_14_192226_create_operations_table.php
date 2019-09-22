<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('sum', 8, 2);
            $table->bigInteger('category_id')->unsigned();
            $table->text('description')->nullable();
            $table->bigInteger('user_id')->unsigned();;
            $table->timestamps();
        });

        Schema::table('operations', function(Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('operations', function(Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('operations');
    }
}
