<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAddress extends Model
{
    use HasFactory;

    protected $table = 'employee_addresses';
    protected $fillable = [
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'zipcode',
    ];
}
