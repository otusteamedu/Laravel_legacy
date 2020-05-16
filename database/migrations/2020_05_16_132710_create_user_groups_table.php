<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->comment('Алиас');
            $table->string('title')->comment('Название');
        });

        DB::insert('insert into user_groups (name, title)
            values (?,?)',['Admin', 'Администратор']);
        DB::insert('insert into user_groups (name, title)
            values (?,?)',['Guest', 'Гость']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_groups');
    }
}
