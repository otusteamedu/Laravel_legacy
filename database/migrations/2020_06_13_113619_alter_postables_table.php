<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPostablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('postables', function (Blueprint $table) {
            $table->renameColumn('receiver_model', 'postable_type');
            $table->renameColumn('receiver_id', 'postable_id');
        });

        Schema::table('postables', function (Blueprint $table) {
            $table->unique(['post_id', 'postable_type', 'postable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('postables', function (Blueprint $table) {
            $table->renameColumn('postable_type', 'receiver_model');
            $table->renameColumn('postable_id', 'receiver_id');
        });
    }
}
