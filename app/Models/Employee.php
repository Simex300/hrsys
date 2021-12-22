<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'phone',
        'date_of_birth',
        'gender',
        'address_id',
        'user_id',
        'email',
        'role',
        'department',
        'salary',
        'salary_rate',
        'hire_at'
    ];

    public function address() {
        return $this->belongsTo(EmployeeAddress::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function attendances() {
        return $this->hasMany(EmployeeAttendance::class);
    }

    public function contract() {
        return $this->hasMany(EmployeeContract::class);
    }

    public function wages() {
        return $this->hasMany(EmployeeWage::class);
    }
}
