<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('business_id');
            $table->text('address');
        });

        Schema::table('business_address', function (Blueprint $table) {
            $table->index('business_id');
            $table->foreign('business_id')
                ->references('id')
                ->on('business')
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
        Schema::dropIfExists('business_address');
    }
}
