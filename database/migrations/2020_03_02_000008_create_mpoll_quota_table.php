<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMpollQuotaTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mpoll_quota';
    /**
     * Run the migrations.
     * @table mpolls_quotas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('mpoll_id')->nullable()->default(null);
            $table->integer('quota_id')->nullable()->default(null);
            $table->integer('mstatus_id')->nullable()->default('0');
            $table->integer('completes')->nullable()->default('0');
            $table->integer('sent')->nullable()->default('0')->comment('Sent quontity of emails');
            $table->integer('send_posible')->nullable()->default('0')->comment('Posibility to send');
            $table->integer('sending')->nullable()->default('0')->comment('Order for sending');
            $table->string('order', 10)->nullable()->default('RAND()')->comment('Sort order for mail sending');
            $table->integer('clicks')->nullable()->default('0');
            $table->string('prescreener')->nullable()->default(null);
            $table->integer('overquota')->nullable()->default('0');
            $table->integer('screenout')->nullable()->default('0');
           /* $table->dateTime('created_at')->nullable()->default(null);
            $table->dateTime('updated_at')->nullable()->default(null);*/
            $table->integer('complete')->nullable()->default('0');
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
