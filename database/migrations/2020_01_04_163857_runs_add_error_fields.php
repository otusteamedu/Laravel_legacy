<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RunsAddErrorFields extends Migration
{
    public function up()
    {
        \Schema::table('runs', function (Blueprint $table) {
            $table->string('error_phploc', 2000)->default('');
            $table->string('error_phpinsights', 2000)->default('');
        });
    }

    public function down()
    {
        \Schema::table('runs', function (Blueprint $table) {
            $table->dropColumn('error_phploc');
            $table->dropColumn('error_phpinsights');
        });
    }
}
