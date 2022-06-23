<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerritoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('territories', function (Blueprint $table) {
            $table->id('territory_id');

            $table->unsignedBigInteger('zone_id');
            $table->foreign('zone_id')->references('zone_id')->on('zones');

            $table->unsignedBigInteger('region_id');
            $table->foreign('region_id')->references('region_id')->on('regions');

            $table->string('territory_name');
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
        Schema::dropIfExists('territories');
    }
}
