<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('user_group_rights', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->index()->nullable(false);
            $table->text('description')->nullable();
            $table->unsignedBigInteger('group_id')->nullable(false);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on(\CreateUserGroupsTable::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_group_rights');
    }
}
