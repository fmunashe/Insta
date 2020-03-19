<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('asset_number');
            $table->string('asset_name');
            $table->string('asset_location');
            $table->string('asset_classification');
            $table->string('date_acquired');
            $table->unsignedBigInteger('dep_method')->default(0);
            $table->string('span');
            $table->string('dep_rate');
            $table->string('narration');
            $table->string('invoice_number');
            $table->string('invoice_details');
            $table->string('purchase_price');
            $table->string('transport_cost')->default(0);
            $table->string('other_cost')->default(0);
            $table->string('depreciation');
            $table->string('total_cost');
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
        Schema::dropIfExists('assets');
    }
}
