<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructions', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('hard');

            $table->string('code')->unique();
            $table->string('type_code');

            $table->unsignedBigInteger('created_account_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('constructions', function (Blueprint $table) {
            $table->foreign('created_account_id')
                ->references('id')
                ->on('accounts');
        });

        Schema::table('constructions', function (Blueprint $table) {
            $table->foreign('type_code')
                ->references('code')
                ->on('construction_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constructions');
    }
}
