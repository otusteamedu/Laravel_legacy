<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCommentsAuthorIdTargetId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table){
            $table->foreign('author_id')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->foreign('target_id')
                ->references('id')->on('users')
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
        Schema::table('comments', function (Blueprint $table){
            $table->dropForeign('comments_author_id_foreign');
        });

        Schema::table('comments', function (Blueprint $table){
            $table->dropForeign('comments_target_id_foreign');
        });
    }
}
