<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('company_id')->nullable();
            $table->unsignedBigInteger('widget_id');
            $table->unsignedBigInteger('manager_id');
            $table->unsignedBigInteger('lead_id');
            $table->longText('text');
            $table->json('info')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('conversations', function (Blueprint $table) {
            $table->foreign('widget_id')
                ->references('id')
                ->on('widgets')
                ->onDelete('cascade');
            $table->foreign('lead_id')
                ->references('id')
                ->on('leads')
                ->onDelete('cascade');
            $table->foreign('manager_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
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
        Schema::dropIfExists('conversations');
    }
}
