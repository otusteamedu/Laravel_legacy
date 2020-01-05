<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRubricTable extends Migration
{
    /** @var string  */
    protected const TABLE = 'post_rubric';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->unsignedInteger('post_id')->nullable(false)->comment('ID новости');
            $table->unsignedInteger('rubric_id')->nullable(false)->comment('ID рубрики');
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->unique(['post_id', 'rubric_id']);
            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('restrict');
            $table->foreign('rubric_id')
                ->references('id')
                ->on('rubrics')
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
