<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEmployeeTablesResetForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee_attendance', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::table('employee_waves', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::table('employee_contract', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
        });

        Schema::rename('employee_attendance', 'employee_attendances');
        Schema::rename('employee_waves', 'employee_wages');
        Schema::rename('employee_contract', 'employee_contracts');
        Schema::rename('employee_address', 'employee_addresses');

        Schema::table('employee_attendances', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('employee_wages', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('employee_contracts', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('employee_addresses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_attendances', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::table('employee_wages', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::table('employee_contracts', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
        });

        Schema::rename('employee_attendances', 'employee_attendance');
        Schema::rename('employee_wages', 'employee_waves');
        Schema::rename('employee_contracts', 'employee_contract');
        Schema::rename('employee_addresses', 'employee_address');

        Schema::table('employee_attendance', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('employee_waves', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('employee_contract', function (Blueprint $table) {
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('address_id')->references('id')->on('employee_address');
        });
    }
}
