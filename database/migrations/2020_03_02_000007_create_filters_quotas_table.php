<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateFiltersQuotasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'filter_quota';
    /**
     * Run the migrations.
     * @table filters_quotas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('filter_id')->nullable()->default(null);
            $table->integer('quota_id')->nullable()->default(null);
            /*$table->dateTime('created_at')->nullable()->default(null);
            $table->dateTime('updated_at')->nullable()->default(null);*/
            $table->timestamps();
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
