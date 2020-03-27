<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->string('alias', 50)->unique();
            $table->string('icon', 50)->unique();
            $table->decimal('min', 2,1)->unsigned();
            $table->decimal('max', 2,1)->unsigned();
            $table->timestamps();
        });

        Schema::table('images', function(Blueprint $table) {
            $table->foreign('format_id')->references('id')->on('formats')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('formats');
    }
}
