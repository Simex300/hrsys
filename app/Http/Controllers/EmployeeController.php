<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Faker;
use Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('address')->with('user')->get()->toArray();
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
        $filepath = "";
        DB::beginTransaction();
        try {
            $addressRequest = json_decode($request->input('address'));
            $employeeAddress = new EmployeeAddress([
                'address1' => $addressRequest->address1,
                'address2' => $addressRequest->address2,
                'city' => $addressRequest->city,
                'state' => $addressRequest->state,
                'country' => $addressRequest->country,
                'zipcode' => $addressRequest->zipcode,
            ]);
            $employeeAddress->save();

            $userRequest = json_decode($request->input('user'));
            $employeeUser = new User([
                'email' => $userRequest->email,
                'password' => Hash::make($userRequest->password),
            ]);
            $employeeUser->save();

            $employee = new Employee([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'date_of_birth' => $request->input('date_of_birth'),
                'gender' => $request->input('gender'),
                'address_id' => $employeeAddress->id,
                'user_id' => $employeeUser->id,
                'email' => $userRequest->email,
                'role' => $request->input('role'),
                'department' => $request->input('department'),
                'salary' => $request->input('salary'),
                'salary_rate' => $request->input('salary_rate'),
                'hire_at' => $request->input('hire_at'),
            ]);

            $employee->save();
            if($request->hasFile('profile')) {
                $faker = Faker\Factory::create();
                $filename = $faker->sha1;
                $extension = $request->file('profile')->getClientOriginalExtension();
                $filepath = $request->file('profile')->storeAs("/public/images/employee/{$employee->id}", "{$filename}.{$extension}");
                $employee->profile = str_replace("public/", "", $filepath);
            }
            $employee->save();

            DB::commit();
            return response()->json($employee);
        }
        catch (\Throwable $e) {
            DB::rollback();
            Storage::delete($filepath);
            // TODO: Remove file if transaction fails
            return response()->json($filepath, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return response()->json($employee->with('address')->with('user')->find($employee->id));
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
        $filepath = "";
        DB::beginTransaction();
        try {
            $addressRequest = json_decode($request->input('address'));
            $employeeAddress = EmployeeAddress::find($employee-> address_id);
            $employeeAddress->update([
                'address1' => $addressRequest->address1,
                'address2' => $addressRequest->address2,
                'city' => $addressRequest->city,
                'state' => $addressRequest->state,
                'country' => $addressRequest->country,
                'zipcode' => $addressRequest->zipcode,
            ]);

            $employee->update([
                'first_name' => $request->input('first_name'),
                'middle_name' => $request->input('middle_name'),
                'last_name' => $request->input('last_name'),
                'phone' => $request->input('phone'),
                'date_of_birth' => $request->input('date_of_birth'),
                'gender' => $request->input('gender'),
                'role' => $request->input('role'),
                'department' => $request->input('department'),
                'salary' => $request->input('salary'),
                'salary_rate' => $request->input('salary_rate'),
                'hire_at' => $request->input('hire_at'),
            ]);

            if($request->hasFile('profile')) {
                Storage::delete("public/{$employee->profile}");

                $faker = Faker\Factory::create();
                $extension = $request->file('profile')->getClientOriginalExtension();
                $filename = $faker->sha1;
                $filepath = $request->file('profile')->storeAs("/public/images/employee/{$employee->id}", "{$filename}.{$extension}");

                $employee->profile = str_replace("public/", "", $filepath);
            }

            $employee->save();
            DB::commit();
            return response()->json($employee);
        }
        catch (\Throwable $e) {
            DB::rollback();
            Storage::delete($filepath);
            // TODO: Remove file if transaction fails
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if(Storage::exists("/public/images/employee/{$employee->id}"))
            Storage::deleteDirectory("public/images/employee/{$employee->id}");
        $employee->delete();
        return response()->json("Employee deleted sucessfully!");
    }
}
