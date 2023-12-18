@extends('base')
@include('_navbar')

@section('content')

<div class="bg-gray-50 p-8 rounded-md w-full ">
    <form method="POST" action="{{ route('payroll.store') }}" >
        {{csrf_field()}}
        <h1 class="text-center text-2xl mb-6 text-green-600 font-bold font-sans">Create Payroll</h1>
        <div class="flex mb-2">
            <label class="leading-loose px-3">Date Covered From: </label>
            <input type="date" class="border rounded-lg h-8 w-100 mr-2 px-3 py-2   text-sm  text-gray-600"/>

            <label class="leading-loose px-3">Date Covered To: </label>
            <input type="date" class="border rounded-lg px-3 py-2  text-sm h-8 w-100  text-gray-600"/>

          </div>
        <div class="mb-2">
            <label class="leading-loose px-3">No. of Working Days: </label>
            <input type="number" class="border rounded-lg px-3 py-2  text-sm h-8 w-100  text-gray-600" />
        </div>

		<div>
			<div class="mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
				<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
					<table class="min-w-full leading-normal bg-gray-50">
						<thead>
							<tr>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Employee
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Rate
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Days Worked
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Total Basic Pay
								</th>
								<th  colspan="2"
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Overtime
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Gross Amount
								</th>

								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Cash Advance
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Personal Deductions
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Cash Advance Balance
								</th>
								<th
									class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
									Net Amount
								</th>


							</tr>
                            <tr >
                                <th colspan="4"></th> <!-- Placeholder for empty cells -->
                                <th class="px-5 py-3  text-xs font-semibold text-gray-600 uppercase tracking-wider">Overtime Hours</th>
                                <th class="px-5 py-3  text-xs font-semibold text-gray-600 uppercase tracking-wider">Overtime Amount</th>
                                <th colspan="5"></th> <!-- Placeholder for empty cells -->
                              </tr>
						</thead>
						<tbody>
                            @foreach ($employees as $emp)
                            <tr>
                                <td class="px-6 py-5 text-sm">
                                    <div class="flex items-center">
                                        <div class="ml-3">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                {{ $emp->user->firstName }} {{ $emp->user->lastName }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-5 py-5 text-sm">
                                    <p class="text-gray-900 whitespace-no-wrap"> ₱{{ $emp->position->rate }}</p>
                                </td>

                                <!-- Other table cells -->

                                <td class="px-5 py-5 text-sm">
                                    <input
                                        type="text"
                                        name="payrolls[{{ $emp->id }}][days_worked]"
                                        value="{{ old("payrolls.$emp->id.days_worked") ?? 0 }}"
                                        class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100"
                                        oninput="updateTotalBasicPay({{ $emp->id }}, {{ $emp->position->rate ?? 0 }})"
                                    >
                                </td>

                                <td class="px-5 py-5 text-sm">
                                    <input
                                        type="text"
                                        name="payrolls[{{ $emp->id }}][totalBasicPay]"
                                        value="{{ old("payrolls.$emp->id.totalBasicPay") ?? 0 }}"
                                        class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100"
                                        readonly
                                    >
                                </td>

                                <td class="px-5 py-5 text-sm">
                                    <input type="text" name="payrolls[{{ $emp->id }}][totalBasicPay]"  class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100">
                                </td>
                                <td class="px-5 py-5 text-sm">
                                    <input type="text" name="payrolls[{{ $emp->id }}][totalBasicPay]"  class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100">
                                </td>
                                <td class="px-5 py-5 text-sm">
                                    <input type="text" name="payrolls[{{ $emp->id }}][totalBasicPay]"  class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100">
                                </td>
                                <td class="px-5 py-5 text-sm">
                                    <input
                                        type="text"
                                        name="payrolls[{{ $emp->id }}][cashAdvance]"
                                        value="{{ $cashAdvance->where('emp_id', $emp->id)->first()->totalCashAdvance ?? 0 }}"
                                        class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100 cash-advance-input"
                                        readonly
                                        data-emp-id="{{ $emp->id }}"

                                    >
                                </td>
                                <td class="px-5 py-5 text-sm">
                                    <input
                                        type="text"
                                        name="payrolls[{{ $emp->id }}][personalDeduction]"
                                        value=""
                                        class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100 personal-deduction-input deduction-input"
                                        data-emp-id="{{ $emp->id }}"
                                        oninput="updateTotalBalance({{ $emp->id }}, {{ $emp->cashAdvance->amount ?? 0 }})"
                                    >
                                </td>
                                <td class="px-5 py-5 text-sm">
                                    <input type="text" name="payrolls[{{ $emp->id }}][totalDeductions]"  class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100">
                                </td>


                                {{-- <td class="px-5 py-5 text-sm">
                                    <input type="text" name="payrolls[{{ $emp->id }}][totalBasicPay]"  class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100">
                                </td> --}}
                                <td class="px-5 py-5 text-sm">
                                    <input type="text" name="payrolls[{{ $emp->id }}][totalBasicPay]"  class="text-gray-900 whitespace-no-wrap px-5 py-3 bg-gray-100">
                                </td>
                            </tr>
                        @endforeach

						</tbody>

					</table>


				</div>
                <button type="submit" class="flex justify-end mt-6 bg-green-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans mb-5">Create payroll</button>
			</div>

	</div>
</form>

@endsection

<script>

function create() {
     const employees = @json($employees);

    const payrolls = employees.map(emp => ({
                emp_id: emp.id,
                days_worked: '',
                total_basic_pay: 0,
                overtimeHours: 0,
                overtimeAmount: 0,
                grossAmount: 0,
                personalDeduction: 0,
                totalDeductions: 0,
                cashAdvance: getCashAdvanceTotal(emp.id), // Fix: Use emp.id instead of employee.id
                netAmount: 0,
            }));

            console.log(payrolls);
        }

        function updateTotalBasicPay(empId, rate) {
            const daysWorkedInput = document.querySelector(`[name="payrolls[${empId}][days_worked]"]`);
            const totalBasicPayInput = document.querySelector(`[name="payrolls[${empId}][totalBasicPay]"]`);

            const daysWorked = parseFloat(daysWorkedInput.value) || 0;
            const totalBasicPay = rate * daysWorked;

            totalBasicPayInput.value = totalBasicPay.toFixed(2);
        }

        function getCashAdvanceTotal(empid) {
            // Find the cash advance entry for the specified employee ID
            const cashAdvanceEntry = cashAdvances.find(entry => entry.emp_id === emp_id);

            // Return 0 if there's no corresponding entry, otherwise return the value of totalCashAdvance
            return cashAdvanceEntry ? cashAdvanceEntry.totalCashAdvance : 0;
        }
        function updateTotalBalance(empId, totalCashAdvance) {
            const cashAdvanceInput = document.querySelector(`[name="payrolls[${empId}][cashAdvance]"]`);
            const personalDeductionInput = document.querySelector(`[name="payrolls[${empId}][personalDeduction]"]`);
            const totalDeductionsInput = document.querySelector(`[name="payrolls[${empId}][totalDeductions]"]`);

            // Ensure that the personalDeductionInput value is a valid number
            const personalDeduction = parseFloat(personalDeductionInput.value) || 0;
            const cashAdvance = parseFloat(cashAdvanceInput.value);

            // Ensure that the cashAdvance is a valid number
            totalCashAdvance = parseFloat(totalCashAdvance) || 0;

            // Perform the subtraction
            const totalDeductions = cashAdvance !== 0 ? cashAdvance - personalDeduction : 0;

            // Assuming you want to display the result in the input field
            totalDeductionsInput.value = totalDeductions.toFixed(2);
        }








</script>
