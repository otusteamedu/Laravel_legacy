<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /** @var string  */
    protected const TABLE = 'comments';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content')->comment('Текст комментария');
            $table->unsignedInteger('user_id')->nullable(false)->comment('ID пользователя');
            $table->unsignedInteger('post_id')->nullable(false)->comment('ID новости');
            $table->unsignedInteger('comment_id')->nullable()->comment('ID родительского комментария');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('restrict');

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('restrict');

            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
}
