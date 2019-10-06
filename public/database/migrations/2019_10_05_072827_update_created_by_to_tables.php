<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCreatedByToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('flows', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(0);
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(0);
        });
        Schema::table('reasons', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(0);
        });
        Schema::table('responsibilities', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('flows', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
        Schema::table('reasons', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
        Schema::table('responsibilities', function (Blueprint $table) {
            $table->dropColumn('created_by');
        });
    }
}
