<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotosSurnameBirthToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('phone', 100)->nullable()->after('email');
            $table->string('surname', 100)->nullable()->after('name');
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->bigInteger('file_id')->unsigned()->nullable();
            $table->date('birthday')->nullable();
            $table->boolean('active')->default(true);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
            	->onDelete('cascade');

            $table->index('phone');
            $table->index('active');
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
            //
            $table->dropForeign('file_id');
            $table->dropColumn(['surname', 'file_id', 'birthday', 'phone']);
        });
    }
}
