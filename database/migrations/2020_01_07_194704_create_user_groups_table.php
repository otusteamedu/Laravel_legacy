<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserGroupsTable extends Migration
{
    public const TABLE_NAME = 'user_groups';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE_NAME, static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->index()->nullable(false);
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::table('users', static function (Blueprint $table) {
            $table->foreign('group_id')->references('id')->on(self::TABLE_NAME);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', static function (Blueprint $table) {
            $table->dropForeign('group_id');
        });

        Schema::dropIfExists(self::TABLE_NAME);
    }
}
