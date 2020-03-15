<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('position_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('joining_date');
            $table->string('mobile_number');
            $table->string('date_of_birth');
            $table->string('gender');
            $table->string('address');
            $table->string('school');
            $table->string('attained');
            $table->string('completion_year');
            $table->string('company');
            $table->string('position_held');
            $table->string('position_years');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('employees');
    }
}
