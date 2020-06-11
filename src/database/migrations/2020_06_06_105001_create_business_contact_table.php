<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_contact', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('business_id');
            $table->unsignedSmallInteger('type_id')->nullable();
            $table->string('contact');
            $table->timestamps();
        });

        Schema::table('business_contact', function (Blueprint $table) {
            $table->index('business_id');
            $table->foreign('business_id')
                ->references('id')
                ->on('business')
                ->onDelete('cascade');

            $table->index('type_id');
            $table->foreign('type_id')
                ->references('id')
                ->on('business_contact_types')
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
        Schema::dropIfExists('business_contact');
    }
}
