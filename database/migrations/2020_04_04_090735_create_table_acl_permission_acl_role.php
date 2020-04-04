<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableAclPermissionAclRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_permission_acl_role', function (Blueprint $table) {
            $table->bigInteger('acl_role_id')->unsigned();
            $table->foreign('acl_role_id')->references('id')->on('acl_roles')->onDelete('cascade');

            $table->bigInteger('acl_permission_id')->unsigned();
            $table->foreign('acl_permission_id')->references('id')->on('acl_permissions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acl_permission_acl_role');
    }
}
