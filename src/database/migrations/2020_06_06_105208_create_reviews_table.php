<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedbigInteger('business_id');
            $table->unsignedbigInteger('user_id');
            $table->unsignedbigInteger('worker_id')->nullable()
                ->comment('id пользователя, если отзыв для конкретного работника');
            $table->unsignedbigInteger('procedure_id')->nullable()
                ->comment('id процедуры, если отзыв для конкретнй процедуры');
            $table->tinyInteger('rating');
            $table->text('text');
            $table->timestamps();
        });

        Schema::table('reviews', function (Blueprint $table) {
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

            $table->index('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->index('procedure_id');
            $table->foreign('procedure_id')
                ->references('id')
                ->on('procedures')
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
        Schema::dropIfExists('reviews');
    }
}
