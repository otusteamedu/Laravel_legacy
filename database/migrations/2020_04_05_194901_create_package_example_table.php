<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageExampleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_example', function (Blueprint $table) {
            $table->integer('package_id')->unsigned()->index();
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');

            $table->integer('example_id')->unsigned()->index();
            $table->foreign('example_id')->references('id')->on('examples')->onDelete('cascade');

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
        Schema::dropIfExists('package_example');
    }
}
