<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMastersClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('masters_clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('master_id')->index();
            $table->unsignedBigInteger('client_id');
            $table->timestamps();

            $table->foreign('master_id')->references('id')->on('users');
            $table->foreign('client_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('masters_clients');
    }
}
