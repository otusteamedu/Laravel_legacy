<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /** @var string  */
    protected const TABLE = 'users';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('Имя пользователя');
            $table->string('icon')->comment('Аватарка пользователя');
            $table->string('email')->unique()->comment('Email пользователя');
            $table->string('password')->comment('Пароль');
            $table->unsignedInteger('group_id')->nullable(false)->comment('ID группы');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
