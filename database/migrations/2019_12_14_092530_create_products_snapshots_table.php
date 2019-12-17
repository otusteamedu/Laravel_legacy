<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateProductsSnapshotsTable
 *
 * @link https://portals.aliexpress.com/help.htm?page=help_center_api
 *       1.1 listPromotionProduct
 *          1.1.3 Output Parameter
 */
class CreateProductsSnapshotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_snapshots', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedBigInteger('productId');
            $table->string('originalPrice');
            $table->string('salePrice');
            $table->string('localPrice');
            $table->string('discount');
            $table->date('validTime');
            $table->timestamps();
        });

        Schema::table('products_snapshots', function (Blueprint $table) {
            $table->foreign('productId')
                ->references('productId')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_snapshots');
    }
}
