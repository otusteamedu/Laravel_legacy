<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionApiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('function_api', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->mediumText('function');
            $table->mediumText('description')->nullable();
            $table->integer('role_available')->default(3);
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
        Schema::dropIfExists('function_api');
    }
}
