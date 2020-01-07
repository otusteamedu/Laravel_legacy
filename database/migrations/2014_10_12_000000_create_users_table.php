<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            # Column methods   : https://laravel.com/docs/6.x/migrations#columns
            # Column modifiers : https://laravel.com/docs/6.x/migrations#column-modifiers
            $table->bigIncrements('id');
            $table->string('source')->default('');   //добавил
            $table->date('date')->default(now());                    //добавил
            $table->string('type')->default('');     //добавил
            $table->string('operator')->default('');
            $table->string('name')->default('');
            $table->string('phone')->default('');    //добавил
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable(); //это поле не нужно
            $table->string('address')->default('');  //добавил
            $table->string('comments')->nullable(); //добавил
            $table->string('is_enemy')->default(''); //добавил
            $table->timestamps();
            // Себе на будущее : по плану хочу отвязать пароль, логин, токен от пользователя и
            // перенести в специально созданную для этого сущность Account.
            // В этом задании, оставляю эти стандартные поля здесь.
            $table->string('password')->nullable();
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
