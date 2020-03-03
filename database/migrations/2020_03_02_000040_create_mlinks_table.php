<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMlinksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mlinks';
    /**
     * Run the migrations.
     * @table mlinks
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('mpoll_id');
            $table->string('link')->nullable()->default(null);
            $table->integer('user_id')->nullable()->default(null);
            $table->integer('status')->nullable()->default('0');
            $table->string('user_ip', 16)->nullable()->default(null);
            $table->dateTime('created')->nullable()->default(null);
            $table->dateTime('modified')->nullable()->default(null);

            $table->index(["mpoll_id"], 'mpoll_id_ind');

            $table->index(["user_id"], 'user_id_ind');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
