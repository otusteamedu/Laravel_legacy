<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddNewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('group_id')
                ->default(2)
                ->nullable()
                ->comment('Идентификатор группы пользователя');
            $table->string('avatar')->comment('Аватар')->default('/img/avatar.svg');
            $table->foreign('group_id')
                ->references('id')
                ->on('user_groups')
                ->onDelete('set null');
            $table->index('group_id');
            $table->string('api_token')->after('password')->unique()->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('group_id', 'avatar', 'api_token');
        });
    }
}
