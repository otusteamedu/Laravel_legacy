<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateQuotasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'quotas';
    /**
     * Run the migrations.
     * @table quotas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('country_id')->comment('event id from CINT');
            $table->integer('mpoll_id')->nullable()->default(null);
            $table->string('name', 50);
            $table->string('description', 250);
            $table->integer('completes')->nullable()->default('0');
            $table->integer('over_quotas')->nullable()->default('0');
            $table->integer('screenout')->nullable()->default('0');
            $table->dateTime('created')->nullable()->default(null);
            $table->dateTime('modified')->nullable()->default(null);
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
