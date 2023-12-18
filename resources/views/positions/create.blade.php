
@extends('base')
@include('_navbar')

@section('content')
    <!-- component -->
<!-- Create by joker banny -->
<div class="h-screen bg-gray-50 p-5 flex justify-center items-center">
	<div class="lg:w-2/5 md:w-1/2 w-2/3">
        <form method="POST" action="{{ route('position.store') }}" class="bg-white p-10 rounded-lg shadow-lg min-w-full px-10 ">
            {{csrf_field()}}
			<h1 class="text-center text-2xl mb-6 text-green-600 font-bold font-sans">Create Position</h1>
			<div>
				<label class="text-gray-800 font-semibold block my-3 text-md" for="username">Position</label>
				<input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="position" id="position" placeholder="e.g. Manager" />
            </div>
            @error('position')
                    <p class="text-red-500">{{$message}}</p>
                @enderror
            <div>
                <label class="text-gray-800 font-semibold block my-3 text-md" for="number">Rate</label>
                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="rate" id="rate"  />
            </div>
            @error('rate')
                    <p class="text-red-500">{{$message}}</p>
            @enderror

            <button type="submit" class="w-full mt-6 bg-green-600 rounded-lg px-4 py-2 text-lg text-white tracking-wide font-semibold font-sans mb-5">Create Position</button>

		</form>
	</div>
</div>
@endsection

