<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNormalizedUrlToRepository extends Migration
{
    public function up()
    {
        \Schema::table('repositories', static function (Blueprint $table) {
            $table->string('normalized_url')->after('url')->default('')->unique();
        });
    }

    public function down()
    {
        \Schema::table('repositories', static function (Blueprint $table) {
            $table->dropColumn('normalized_url');
        });
    }
}
