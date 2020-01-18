<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50)->unique();
            $table->text('description')->nullable();
            $table->tinyInteger('publish')->unsigned()->default(0);
            $table->timestamps();
        });

        Schema::table('images', function(Blueprint $table) {
            $table->foreign('owner_id')->references('id')->on('owners')
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
        Schema::dropIfExists('owners');
    }
}
