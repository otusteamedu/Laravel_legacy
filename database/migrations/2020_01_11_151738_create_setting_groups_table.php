<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('alias')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::table('settings', function(Blueprint $table) {
            $table->foreign('group_id')->references('id')->on('setting_groups')
                ->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('setting_groups');
    }
}
