<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenamePostReceiverTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('post_receiver')) {
            Schema::table('post_receiver', function (Blueprint $table) {
                $table->dropUnique(['post_id', 'receiver_model', 'receiver_id']);
            });

            Schema::rename('post_receiver', 'postables');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('users')) {
            Schema::rename('postables', 'post_receiver');

            Schema::table('post_receiver', function (Blueprint $table) {
                $table->unique(['post_id', 'receiver_model', 'receiver_id']);
            });
        }
    }
}
