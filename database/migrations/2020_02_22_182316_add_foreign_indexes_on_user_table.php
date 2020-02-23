<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignIndexesOnUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index(['email', 'phone', 'remember_token'], 'user_index_email_phone_remember_token');
            $table->unique(['email', 'phone'], 'user_unique_email_phone');
            $table->foreign(['tariff_id'], 'user_foreign_tariff_id')
                ->references('id')
                ->on('tariffs')
                ->onDelete('set null');
            $table->foreign(['segment_id'], 'user_foreign_segment_id')
                ->references('id')
                ->on('segments')
                ->onDelete('set null');
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
            $table->dropIndex('user_index_email_phone_remember_token');
            $table->dropUnique('user_unique_email_phone');
            $table->dropForeign('user_foreign_tariff_id');
            $table->dropForeign('user_foreign_segment_id');
        });
    }
}
