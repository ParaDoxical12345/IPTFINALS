
@extends('base')
@include('_navbar')

@section('content')
    <!-- component -->
<!-- Create by joker banny -->
<div class="h-screen bg-gray-50 p-5 flex justify-center items-center">
	<div class="lg:w-2/5 md:w-1/2 w-2/3">
        <form method="POST" action="{{ route('CashAdvance.store') }}" class="bg-white p-10 rounded-lg shadow-lg min-w-full px-10 ">
            {{csrf_field()}}
			<h1 class="text-center text-2xl mb-6 text-green-600 font-bold font-sans">Create Cash Advance</h1>
			<div class="flex -mx-3">
                <div class="w-full px-3 ">
                    <label for="" class="text-gray-800 font-semibold block my-3 text-md">Employee</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="fa-regular fa-user text-gray-400 "></i></div>
                        <select class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"  name="emp_id" id="emp_id">
                            <option disabled selected>Select Employee</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}">{{ $emp->user->firstName }} {{ $emp->user->lastName }}</option>
                             @endforeach
                        </select>
                    </div>
                    @error('emp_id')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                     @enderror
                </div>
            </div>
            <div>
                <label class="text-gray-800 font-semibold block my-3 text-md" for="number"> Requested Date</label>
                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="date" name="requestDate" id="requestDate"  />
                @error('requestDate')
                    <p class="text-red-500">{{$message}}</p>
                 @enderror
            </div>
            <div>
                <label class="text-gray-800 font-semibold block my-3 text-md" for="number"> Amount </label>
                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="number" name="amount" id="amount"  />
                @error('amount')
                    <p class="text-red-500">{{$message}}</p>
                 @enderror
            </div>
            <div>
                <label class="text-gray-800 font-semibold block my-3 text-md" for="number"> Reason </label>
                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="string" name="reason" id="reason"  />
                @error('reason')
                    <p class="text-red-500">{{$message}}</p>
                 @enderror
            </div>
            <button type="submit" class="w-full mt-6 bg-green-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans mb-5">Create Cash Advance</button>
        </div>




		</form>
	</div>
</div>
@endsection

