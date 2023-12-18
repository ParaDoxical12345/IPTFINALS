<?php

namespace App\Http\Controllers;

use App\Models\CashAdvanceTotal;
use App\Models\Employee;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('payroll.index', [
            'payroll' => Payroll::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::with('user', 'advanceTotal', 'position')
            ->whereHas('user', function ($query) {
                $query->where('status', 1);
            })->get();

        $cashAdvance = CashAdvanceTotal::whereIn('emp_id', $employees->pluck('id'))->get();

        return view('payroll.create', [
            'employees' => $employees,
            'cashAdvance' => $cashAdvance
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'payrolls' => 'required|array',
            'payrolls.*.emp_id' => 'required|exists:employees,id',
            'payrolls.*.daysWorked' => 'required|numeric',
            'payrolls.*.overtimeHours' => 'nullable|numeric',
            'payrolls.*.overtimeAmount' => 'nullable|numeric',
            'payrolls.*.totalBasicPay' => 'nullable|numeric',
            'payrolls.*.grossAmount' => 'nullable|numeric',
            'payrolls.*.personalDeduction' => 'nullable|numeric',
            'payrolls.*.cashAdvance' => 'required|nullable',
            'payrolls.*.totalDeductions' => 'nullable|numeric',
            'payrolls.*.netAmount' => 'required|numeric',
        ]);

        $request->validate([
            'payrollPeriodFrom' => 'required|date',
            'payrollPeriodTo' => 'required|date|after:payrollPeriodFrom',
            // ... (other validation rules)
        ]);

        // Create the Payroll instance
        $payroll = Payroll::create([
            'payrollPeriodFrom' => $request->input('payrollPeriodFrom'),
            'payrollPeriodTo' => $request->input('payrollPeriodTo'),
            'noOfDaysWorked' => $request->input('noOfDaysWorked'),
            'total_gross_amount' => $request->input('total_gross_amount'),
            'total_deductions_amount' => $request->input('total_deductions_amount'),
            'total_net_amount' => $request->input('total_net_amount'),
            // ... (other fields)
        ]);

        foreach ($data['payrolls'] as $payrollData) {
            $payrollItem = new Payroll([
                'emp_id' => $payrollData['emp_id'],
                'daysWorked' => $payrollData['daysWorked'],
                'overtimeHours' => $payrollData['overtimeHours'],
                'overtimeAmount' => $payrollData['overtimeAmount'],
                'totalBasicPay' => $payrollData['totalBasicPay'],
                'grossAmount' => $payrollData['grossAmount'],
                'personalDeduction' => $payrollData['personalDeduction'],
                'cashAdvance' => $payrollData['cashAdvance'],
                'totalDeductions' => $payrollData['totalDeductions'],

                'netAmount' => $payrollData['netAmount'],
            ]);

            $employeeTotal = CashAdvanceTotal::firstOrNew(['emp_id' => $payrollData['emp_id']]);
            $employeeTotal->totalCashAdvance -= $payrollData['personalDeduction'];
            $employeeTotal->save();

            $payroll->payrollItem()->save($payrollItem);
        }
        $log_entry = auth()->user()->name.' has added a payroll to the list.';
        UserLog::dispatch($log_entry); //calling the UserLog event with dispatch method and passed the $log_entry as parameter
        Payroll::create($attributes);

        return redirect('/payroll/' . $payroll->id)->with('message', 'Payroll data saved successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Payroll $payroll)
    {
        return view('payroll.show', ['payroll' => $payroll]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payroll $payroll)
    {
        // Fetch necessary data and return the edit view
        return view('payroll.edit', [
            'payroll' => $payroll
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payroll $payroll)
    {
        // Validate and update the Payroll instance
        $payroll->update([
            // ... (update fields based on $request)
        ]);

        // Delete existing payroll items
        $payroll->payrollItem()->delete();

        // Recreate payroll items based on updated data
        foreach ($request->input('payrolls') as $payrollData) {
            $payrollItem = new Payroll([
                // ... (set attributes based on $payrollData)
            ]);

            $employeeTotal = CashAdvanceTotal::firstOrNew(['emp_id' => $payrollData['emp_id']]);
            $employeeTotal->totalCashAdvance -= $payrollData['personalDeduction'];
            $employeeTotal->save();

            $payroll->payrollItem()->save($payrollItem);
        }


        return redirect('/payroll/' . $payroll->id)->with('message', 'Payroll data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payroll $payroll)
    {
        // Delete associated payroll items
        $payroll->payrollItem()->delete();

        // Update CashAdvanceTotal for each employee
        foreach ($payroll->payrollItem as $payrollItem) {
            $employeeTotal = CashAdvanceTotal::firstOrNew(['emp_id' => $payrollItem->emp_id]);
            $employeeTotal->totalCashAdvance += $payrollItem->personalDeduction;
            $employeeTotal->save();
        }

        // Delete the payroll itself
        $payroll->delete();

        return redirect('/payroll')->with('message', 'Payroll data deleted successfully');
    }
}
