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
            $table->bigIncrements('productId');
            $table->string('productTitle', 255);
            $table->string('productUrl');
            $table->string('imageUrl');
            $table->string('originalPrice');
            $table->string('salePrice');
            $table->string('discount');
            $table->unsignedInteger('evaluateScore');
            $table->string('commission');
            $table->string('commissionRate');
            $table->string('30daysCommission');
            $table->unsignedInteger('volume');
            $table->string('packageType');
            $table->unsignedInteger('lotNum');
            $table->date('validTime');
            $table->string('localPrice');
            $table->string('storeUrl');
            $table->string('storeName');
            $table->text('allImageUrls');

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
        Schema::dropIfExists('products_snapshots');
    }
}
