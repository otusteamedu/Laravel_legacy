<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateOrganizationsTable
 * Организации
 */
class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_eng');
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->bigInteger('org_type_id')->unsigned()->nullable();
            $table->bigInteger('org_group_id')->unsigned()->nullable();
            $table->bigInteger('org_branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('org_type_id')->references('id')->on('org_types');
            $table->foreign('org_group_id')->references('id')->on('org_groups');
            $table->foreign('org_branch_id')->references('id')->on('org_branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
