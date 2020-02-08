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
    public function up(): void
    {
        // TODO add CONSTRAINT for date_start and date_finish columns. One master must not have two records for one time interval
        Schema::create('records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id')->index('client')->nullable(false);
            $table->unsignedBigInteger('master_id')->index('master')->nullable(false);
            $table->timestampTz('date_start')->nullable(false);
            $table->timestampTz('date_finish')->nullable(false);
            $table->integer('price')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('master_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
}
