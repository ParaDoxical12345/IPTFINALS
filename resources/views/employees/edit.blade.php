@extends('base')
@include('_navbar')

@section('content')
<div class="h-screen bg-gray-50 p-5 flex justify-center items-center">
	<div class="lg:w-2/5 md:w-1/2 w-2/3">
        <form method="POST" action="{{ route('employee.update', $employee->id) }}" class="bg-white p-10 rounded-lg shadow-lg min-w-full px-10">
            @csrf
            @method('PUT')

            <h1 class="text-center text-2xl mb-6 text-green-600 font-bold font-sans">Edit Employee</h1>
            <div class="flex -mx-3">
                <div class="w-1/2 px-3 mb-5">
                    <label for="" class="text-xs font-semibold px-1">First name</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                        <input type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-green-500" placeholder="John" name="firstName" id="firstName"  value="{{ old('firstName', $employee->user->firstName) }}">

                    </div>
                    @error('firstName')
                        <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                     @enderror
                </div>
                <div class="w-1/2 px-3 mb-5">
                    <label for="" class="text-xs font-semibold px-1">Last name</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                        <input type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-green-500" placeholder="Doe" name="lastName" id="lastName" value="{{ old('lastName', $employee->user->lastName) }}">
                    </div>
                    @error('lastName')
                        <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-1/2 px-3 mb-5">
                    <label for="" class="text-xs font-semibold px-1">Address</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                        <input type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-green-500" placeholder="Skina Japan Street" name="address" id="address" value="{{ old('address', $employee->user->address) }}">

                    </div>
                    @error('address')
                    <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                @enderror
                </div>
                <div class="w-1/2 px-3 mb-5">
                    <label for="" class="text-xs font-semibold px-1">Phone</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-account-outline text-gray-400 text-lg"></i></div>
                        <input type="text" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-green-500" placeholder="09878867" name="phone" id="phone" value="{{ old('phone', $employee->user->phone) }}">

                    </div>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="" class="text-xs font-semibold px-1">Position</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="fa-regular fa-user text-gray-400 "></i></div>
                        <select class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500"  name="pos_id" id="pos_id" >
                            <option disabled selected>Select Position</option>
                            @foreach($position as $pos)
                                <option value="{{ $pos->id }}" @if(old('pos_id', $employee->pos_id) == $pos->id) selected @endif>
                                    {{ $pos->position }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('pos_id')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                     @enderror
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="" class="text-xs font-semibold px-1">Email</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-email-outline text-gray-400 text-lg"></i></div>
                        <input type="email" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="johnsmith@example.com" name="email" id="email" value="{{ old('email', $employee->user->email) }}">

                    </div>
                    @error('email')
                            <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="" class="text-xs font-semibold px-1">Password</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                        <input type="password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************" name="password" id="password" >

                    </div>
                    @error('password')
                            <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="flex -mx-3">
                <div class="w-full px-3 mb-5">
                    <label for="password_confirmation" class="text-xs font-semibold px-1">Confirm Password</label>
                    <div class="flex">
                        <div class="w-10 z-10 pl-1 text-center pointer-events-none flex items-center justify-center"><i class="mdi mdi-lock-outline text-gray-400 text-lg"></i></div>
                        <input type="password" class="w-full -ml-10 pl-10 pr-3 py-2 rounded-lg border-2 border-gray-200 outline-none focus:border-indigo-500" placeholder="************" name="password_confirmation" id="password_confirmation" >

                    </div>
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <button type="submit" class="w-full mt-6 bg-green-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans mb-5">Update Employee</button>
		</form>
	</div>
</div>

@endsection
