<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePublicRunsTable extends Migration
{
    public function up()
    {
        \Schema::create('runs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('url');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('repository_id')->nullable();
            $table->unsignedBigInteger('commit_id')->nullable();
            $table->unsignedInteger('worktime')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();

            $table->foreign('project_id')
                ->on('projects')
                ->references('id');

            $table->foreign('repository_id')
                ->on('repositories')
                ->references('id');

            $table->foreign('commit_id')
                ->on('commits')
                ->references('id');

            $table->foreign('user_id')
                ->on('users')
                ->references('id');
        });

    }

    public function down()
    {
        \Schema::dropIfExists('runs');
    }
}
