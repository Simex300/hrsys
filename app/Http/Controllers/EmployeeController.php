<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Faker;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all()->toArray();
        return array_reverse($employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $employeeAddress = new EmployeeAddress([
                'address1' => $request->input('address1'),
                'address2' => $request->input('address2'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'country' => $request->input('country'),
                'zipcode' => $request->input('zipcode'),
            ]);
            $employeeAddress->save();

            $employee = new Employee([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'address_id' => $employeeAddress->id,
                'email' => $request->input('email'),
                'salary' => $request->input('salary'),
                'salary_rate' => $request->input('salary_rate'),
                'hire_at' => $request->input('hire_at'),
            ]);

            if($request->hasFile('profile')) {
                $faker = Faker\Factory::create();
                $extension = $request->file('profile')->getClientOriginalExtension();
                $filename = $faker->sha1;
                $filepath = $request->file('profile')->storeAs("/public/images/employee/{$request->input('email')}", "{$filename}.{$extension}");

                $employee->profile = str_replace("public/", "", $filepath);
            }

            $employee->save();
            return response()->json($employee);
        });
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return response()->json("Employee data updated sucessfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return response()->json("Employee deleted sucessfully!");
    }
}
