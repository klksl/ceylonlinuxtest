<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_skus', function (Blueprint $table) {
            $table->id('purchase_order_sku_id');
            $table->integer('quantity');
            $table->float('price');

            $table->unsignedBigInteger('sku_id');
            $table->foreign('sku_id')->references('sku_id')->on('skus');

            $table->unsignedBigInteger('purchase_order_id');
            $table->foreign('purchase_order_id')->references('purchase_order_id')->on('purchase_orders');


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
        Schema::dropIfExists('purchase_order_skus');
    }
}
