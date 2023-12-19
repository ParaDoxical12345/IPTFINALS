<?php

namespace App\Http\Controllers;

use App\Models\PayrollItem;
use Illuminate\Http\Request;

class PayrollItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        // Fetch any necessary data
        // You may need to fetch employees, payroll details, etc.
        return view('payrollitem.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'emp_id' => 'required|exists:employees,id',
            'payroll_id' => 'required|exists:payrolls,id',
            'daysWorked' => 'required|numeric|min:0',
            // Add other validation rules as needed
        ]);

        // Create a new PayrollItem instance
        $payrollItem = PayrollItem::create([
            'emp_id' => $request->input('emp_id'),
            'payroll_id' => $request->input('payroll_id'),
            'daysWorked' => $request->input('daysWorked'),
            // Add other fields as needed
        ]);

        // Calculate and update net amount, deductions, or other fields if needed

        // Flash a success message to the session
        session()->flash('message', 'Payroll item created successfully.');

        // Redirect to the index page or any other page
        return redirect()->route('payroll.index');
    }

    public function edit(PayrollItem $payrollItem)
    {
        // Fetch any necessary data and return the edit view
        return view('payrollitem.edit', ['payrollItem' => $payrollItem]);
    }

    public function update(Request $request, PayrollItem $payrollItem)
    {
        // Validate the incoming request data
        $request->validate([
            'daysWorked' => 'required|numeric|min:0',
            // Add other validation rules as needed
        ]);

        // Update the PayrollItem instance
        $payrollItem->update([
            'daysWorked' => $request->input('daysWorked'),
            // Update other fields as needed
        ]);

        // Calculate and update net amount, deductions, or other fields if needed

        // Flash a success message to the session
        session()->flash('message', 'Payroll item updated successfully.');

        // Redirect to the index page or any other page
        return redirect()->route('payroll.index');
    }
}
