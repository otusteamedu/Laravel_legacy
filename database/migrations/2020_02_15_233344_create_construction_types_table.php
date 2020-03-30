<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('construction_types', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->string('name');
            $table->text('description');
            $table->string('code')->unique();

            $table->unsignedBigInteger('created_account_id');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::table('construction_types', function (Blueprint $table) {
            $table->foreign('created_account_id')
                ->references('id')
                ->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('construction_types');
    }
}
