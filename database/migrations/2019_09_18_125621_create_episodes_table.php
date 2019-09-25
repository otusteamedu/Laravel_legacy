<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 500)->default('');
            $table->integer('season')->nullable()->default(null);
            $table->integer('no')->nullable()->default(null);
            $table->text('show_notes');
            $table->unsignedBigInteger('podcast_id')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::table('episodes', function(Blueprint $table) {
            $table->foreign('podcast_id')
                ->on('podcasts')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
