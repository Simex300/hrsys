<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployeeTableAddRoleDepartmentAndPersonal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('phone', 20)->after('last_name');
            $table->date('date_of_birth')->after('phone')->nullable();
            $table->enum('gender', ['male', 'female'])->after('date_of_birth');
            $table->string('role', 50)->after('profile');
            $table->string('department', 50)->after('role');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['phone', 'date_of_birth', 'gender', 'role', 'department']);
        });
    }
}
