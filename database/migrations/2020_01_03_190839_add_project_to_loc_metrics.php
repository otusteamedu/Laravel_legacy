<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProjectToLocMetrics extends Migration
{
    public function up()
    {
        \Schema::table('loc_metrics', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('repository_id')->nullable();

            $table->foreign('project_id')->on('projects')->references('id');
            $table->foreign('repository_id')->on('repositories')->references('id');
        });
    }

    public function down()
    {
        \Schema::table('loc_metrics', function (Blueprint $table) {
            $table->dropForeign('loc_metrics_project_id_foreign');
            $table->dropForeign('loc_metrics_repository_id_foreign');
            $table->dropColumn('project_id');
        });
    }
}
