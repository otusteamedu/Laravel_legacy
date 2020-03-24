<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateMpollsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'mpolls';
    /**
     * Run the migrations.
     * @table mpolls
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45)->nullable()->default(null);
            /*$table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable()->default(null);*/
            $table->integer('mstatus_id')->nullable()->default('0');
            $table->integer('mtype_id')->nullable()->default(null);
            $table->dateTime('starttime')->nullable()->default(null)->comment('Surveyee start');
            $table->dateTime('endtime')->nullable()->default(null)->comment('Surveyee end time');
            $table->decimal('price', 10, 2);
            $table->string('description')->nullable()->default(null);
            $table->integer('click')->nullable()->default('0')->comment('Clicks counter');
            $table->tinyInteger('repeatable')->nullable()->default('0')->comment('Can user click more times');
            $table->integer('country_id')->nullable()->default(null);
            $table->string('length', 10)->nullable()->default(null)->comment('Polls (projects)');
            $table->integer('survlimit')->nullable()->default(null)->comment('Surveyee limit');
            $table->string('prescreener')->nullable()->default(null)->comment('prescreener');
            $table->string('singleLink')->nullable()->default(null);
            $table->string('filename', 45)->nullable()->default(null)->comment('mlinks source file');
            $table->string('key')->nullable()->default(null)->comment('CrKey');
            $table->tinyInteger('incabinet')->nullable()->default('0')->comment('Show in cabinet Yes - 1 | 0 - No');
            $table->string('cab_link')->nullable()->default(null)->comment('link in cabunet XXX in the end');
            $table->string('cab_price', 50)->nullable()->default(null)->comment('shwo that price in cabinet');
            $table->integer('completes')->nullable()->default('0')->comment('Total completed');
            $table->integer('overquotas')->nullable()->default('0')->comment('Total got overquotas');
            $table->integer('screenout')->nullable()->default('0')->comment('Total screenout');
            $table->integer('mail_id')->nullable()->default(null);
            $table->tinyInteger('check_geo')->nullable()->default('1')->comment('1- check; 0 - no;');
            $table->integer('customer_id')->nullable()->default('0')->comment('Cint, fed');
            $table->softDeletes();
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
