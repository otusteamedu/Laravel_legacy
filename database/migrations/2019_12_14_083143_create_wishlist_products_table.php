<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist_products', function (Blueprint $table) {
            $table->unsignedBigInteger('wishlist_id')->index();
            $table->unsignedBigInteger('product_id')->index();
            $table->double('expected_price');
            $table->timestamps();
        });

        Schema::table('wishlist_products', function (Blueprint $table) {
            $table->primary('product_id');
            $table->foreign('wishlist_id')
                  ->references('id')
                  ->on('wishlists')
                  ->onDelete('cascade');
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wishlists_products');
    }
}
