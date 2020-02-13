<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOrgGroupsTable
 * Группы компаний
 */
class CreateOrgGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('org_groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Название');
            $table->string('name_eng')->comment('Название, англ');
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
        Schema::dropIfExists('org_groups');
    }
}
