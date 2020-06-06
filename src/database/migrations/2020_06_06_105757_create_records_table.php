<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('business_id');
            $table->unsignedbigInteger('procedure_id')->nullable();
            $table->unsignedbigInteger('client_id')->nullable();
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->unsignedbigInteger('user_create');
            $table->unsignedbigInteger('user_update');
            $table->tinyInteger('status');
            $table->timestamps();
        });

        Schema::table('records', function (Blueprint $table) {
            $table->index('business_id');
            $table->foreign('business_id')
                ->references('id')
                ->on('business')
                ->onDelete('cascade');

            $table->index('procedure_id');
            $table->foreign('procedure_id')
                ->references('id')
                ->on('procedures')
                ->onDelete('SET NULL');

            $table->index('client_id');
            $table->foreign('client_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('records');
    }
}
