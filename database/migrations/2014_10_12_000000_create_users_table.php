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
            $table->id();
            $table->string('firstname')->comment("Имя");
            $table->string('lastname')->comment("Фамилия");
            $table->string('display_name')->comment("Отображаемое имя");
            $table->string('username')->comment("Имя пользователя");
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->unsignedInteger('level')->default(\App\Models\User::LEVEL_USER)->comment("Уровень");
            $table->string('website')->comment("ссылка на личный сайт");
            $table->string('fb_url')->comment("ссылка на Facebook");
            $table->string('vk_url')->comment("ссылка на Vk");
            $table->string('ok_url')->comment("ссылка на Ok");
   
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
