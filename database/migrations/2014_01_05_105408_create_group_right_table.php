<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupRightTable extends Migration
{
    /** @var string  */
    protected const TABLE = 'group_right';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->unsignedInteger('group_id')->nullable(false)->comment('ID группы');
            $table->unsignedInteger('right_id')->nullable(false)->comment('ID права');
        });

        Schema::table(self::TABLE, function (Blueprint $table) {
            $table->unique(['group_id', 'right_id']);
            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('restrict');
            $table->foreign('right_id')
                ->references('id')
                ->on('rights')
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
