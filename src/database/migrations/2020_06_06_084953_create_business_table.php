<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('user_id')->unsigned()->nullable();
            $table->unsignedSmallInteger('type_id')->nullable();
            $table->boolean("is_block")->default(0);
            $table->timestamps();
        });

        Schema::table('business', function (Blueprint $table) {
//            $table->index('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('SET NULL');

            $table->index('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('business_types')
                ->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business');
    }
}
