<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateReasonTabe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reasons', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->on('groups')
                ->references('id');
            $table->bigInteger('amount')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reasons', function(Blueprint $table)
        {
            $table->dropForeign('group_id');

            $table->dropColumn(array('group_id', 'amount'));
        });
    }
}
