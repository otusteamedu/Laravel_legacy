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
            $table->softDeletes();
            $table->bigIncrements('id');
            $table->boolean('active')->default(0);
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->unsignedBigInteger('country_id');
            $table->string('region');
            $table->string('locality')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('password');
            $table->string('api_token', 80)
                ->unique()
                ->nullable()
                ->default(null);
            $table->unsignedBigInteger('picture_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('picture_id')
                ->references('id')
                ->on('pictures')
                ->onDelete('cascade');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');
        });
    }

    /**
     * @param Blueprint $table
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
