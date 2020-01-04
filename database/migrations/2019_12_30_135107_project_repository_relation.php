<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class ProjectRepositoryRelation extends Migration
{
    public function up()
    {
        \Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('repository_id')->nullable();
            $table->foreign('repository_id')
                ->on('repositories')
                ->references('id');
        });
    }

    public function down()
    {
        \Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_repository_id_foreign');
            $table->dropColumn('repository_id');
        });
    }
}
