<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProxyIdToPlannerSocialNetworkAccounts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('planner_social_network_accounts', function (Blueprint $table) {
            $table->addColumn('integer', 'planner_proxy_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('planner_social_network_accounts', function (Blueprint $table) {
            $table->removeColumn('planner_proxy_id');
        });
    }
}
