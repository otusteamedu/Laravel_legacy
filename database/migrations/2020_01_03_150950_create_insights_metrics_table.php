<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsightsMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insights_metrics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('repository_id');
            $table->unsignedBigInteger('commit_id');
            $table->float('code')->default(0);
            $table->float('complexity')->default(0);
            $table->float('architecture')->default(0);
            $table->float('style')->default(0);
            $table->unsignedInteger('security_issues')->default(0);
            $table->timestamps();

            $table->foreign('project_id')->on('projects')->references('id');
            $table->foreign('repository_id')->on('repositories')->references('id');
            $table->foreign('commit_id')->on('commits')->references('id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insights_metrics');
    }
}
