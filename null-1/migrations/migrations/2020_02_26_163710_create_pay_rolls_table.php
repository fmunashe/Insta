<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayRollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_rolls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('roll_number');
            $table->unsignedBigInteger('employee_id');
            $table->string('salary');
            $table->string('allowance');
            $table->string('deductions');
            $table->unsignedBigInteger('status')->default(0);
            $table->string('total');
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
        Schema::dropIfExists('pay_rolls');
    }
}
