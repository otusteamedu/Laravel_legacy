<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('productId');
            $table->string('productTitle', 255);
            $table->string('productUrl');
            $table->string('imageUrl');
            $table->string('originalPrice');
            $table->string('salePrice');
            $table->string('discount');
            $table->unsignedInteger('evaluateScore');
            $table->string('commission');
            $table->string('commissionRate');
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

        Schema::table('products', function (Blueprint $table) {
            $table->primary('productId')->index();

            $table->foreign('productId')
                ->references('product_id')
                ->on('wishlist_products')
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
        Schema::dropIfExists('products');
    }
}
