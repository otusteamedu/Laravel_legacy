<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlannerPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planner_posts', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->text('description');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('planner_geo_id')->nullable();
            $table->foreign('planner_geo_id')->references('id')->on('planner_geos')->onDelete('set null');

            $table->unsignedBigInteger('planner_soc_network_account_id')->nullable();
            $table->foreign('planner_soc_network_account_id')->references('id')->on('planner_soc_network_accounts')->onDelete('cascade');

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
        Schema::dropIfExists('posts');
    }
}
