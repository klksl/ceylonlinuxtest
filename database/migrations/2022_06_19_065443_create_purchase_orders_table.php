<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id('purchase_order_id');
            $table->string('purchase_no')->unique();
            $table->float('total_amount')->nullable();
            $table->dateTime('purchase_date');
            $table->string('remark')->nullable();

            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')->references('zone_id')->on('zones');

            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('region_id')->on('regions');

            $table->unsignedBigInteger('territory_id');
            $table->foreign('territory_id')->references('territory_id')->on('territories');

            $table->unsignedBigInteger('distributor_id');
            $table->foreign('distributor_id')->references('id')->on('users');

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
        Schema::dropIfExists('purchase_orders');
    }
}
