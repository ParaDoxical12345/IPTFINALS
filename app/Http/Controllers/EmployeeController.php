<?php

namespace App\Http\Controllers;

use App\Events\UserLog;
use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['position', 'user.roles'])->get();

        // Pass the data to the view
        return view('employees.index', compact('employees'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $position = Position::all();
        return view('employees.create', [
            'position'  => $position
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $data = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users',
            'password'   =>'required|confirmed|string|min:6',

        ]);

        $log_entry = 'A new employee has been added.';

        // event
        event(new UserLog($log_entry));

        $user = User::create(array_merge($data, [
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]));
        $employee = new Employee([
            'pos_id' => $request->input('pos_id'),
        ]);

        $user->employee()->save($employee);

        $employeeRole = Role::where('name', 'employee')->first();
        $user->assignRole($employeeRole);

        return redirect('/employees')->with('message', 'Employee successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $position = Position::all();
        $employee->load(['position', 'user.roles'])->get();

        return view('employees.edit', compact('employee', 'position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $user = $employee->user;

        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id, // Exclude current user from email uniqueness check

        ]);

        $user->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        $employee->update([
            'pos_id' => $request->input('pos_id'),
        ]);

        return redirect('/employees')->with('message', 'Employee updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
