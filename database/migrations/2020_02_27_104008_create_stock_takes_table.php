<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTakesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_takes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stock_count');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('quantity');
            $table->string('counted_by');
            $table->string('variance');

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
        Schema::dropIfExists('stock_takes');
    }
}
