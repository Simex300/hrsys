<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_address', function (Blueprint $table) {
            $table->id();
            $table->string("address1");
            $table->string("address2")->nullable();
            $table->string("city", 50);
            $table->string("state", 50);
            $table->string("country", 20);
            $table->string("zipcode")->nullable();
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
        Schema::dropIfExists('employee_address');
    }
}
