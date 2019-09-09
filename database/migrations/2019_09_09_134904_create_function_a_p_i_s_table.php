<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionAPISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('function_a_p_i_s', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->mediumText('function');
            $table->mediumText('description')->nullable();
            $table->integer('role_available');
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
        Schema::dropIfExists('function_a_p_i_s');
    }
}
