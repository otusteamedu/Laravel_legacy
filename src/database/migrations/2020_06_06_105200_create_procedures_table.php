<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('business_id');
            $table->unsignedbigInteger('worker_id')->nullable()
                ->comment('id пользователя, к которому привязана процедура');
            $table->tinyInteger('duration')
                ->comment('Продолжительность в мин.');
            $table->decimal('price', 8, 2);
            $table->tinyInteger('people_count')->default(1)
                ->comment('Кол-во человек для одновременной записи');
        });

        Schema::table('procedures', function (Blueprint $table) {
            $table->index('business_id');
            $table->foreign('business_id')
                ->references('id')
                ->on('businesses')
                ->onDelete('cascade');

            $table->index('worker_id');
            $table->foreign('worker_id')
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
        Schema::dropIfExists('procedures');
    }
}
