<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RenameProjectsGitToUrl extends Migration
{
    public function up()
    {
        \Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('git', 'url');
        });
    }

    public function down()
    {
        \Schema::table('projects', function (Blueprint $table) {
            $table->renameColumn('url', 'git');
        });
    }
}
