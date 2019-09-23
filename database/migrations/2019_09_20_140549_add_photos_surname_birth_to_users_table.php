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
            $table->string('surname', 100)->nullable();
            $table->bigInteger('file_id')->unsigned();
            $table->date('birthday')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
            	->onDelete('cascade');
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
            $table->dropColumn(['surname', 'file_id', 'birthday']);
        });
    }
}
