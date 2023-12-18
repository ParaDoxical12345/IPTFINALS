@extends('base')
@include('_navbar')

@section('content')


<!-- component -->
<div class="bg-gray-50 p-8 rounded-md w-full ">
	<div class=" flex items-center justify-between pb-6">
		<div>
			<h2 class="text-gray-600 font-semibold">List of Cash Advance</h2>
			<span class="text-xs">All employees cash advance </span>
		</div>
		<div class="flex items-center justify-between">

				<div class="lg:ml-40 ml-10 space-x-8">
                    @if(session('message'))
                        <div class="alert bg-green-500 p-4">
                            {{session('message')}}
                        </div>
                    @endif
                    <a href="/cash-advance/create" type="button" class="bg-green-500 px-4 py-2 rounded-md text-white font-normal tracking-wide cursor-pointer">
                        <i class="fa-solid fa-user-plus"></i> Create Cash Advance
                    </a>
					{{-- <button class="bg-indigo-600 px-4 py-2 rounded-md text-white font-semibold tracking-wide cursor-pointer">New Report</button> --}}
					{{-- <button class="bg-green-500 px-4 py-2 rounded-md text-white font-normal tracking-wide cursor-pointer">Create Position</button> --}}
				</div>
			</div>
		</div>
        <div class="flex-1 pr-4 mb-5">
            <div class="relative md:w-1/3">
                <input type="search employee"
                    class="w-full pl-10 pr-4 py-2 rounded-lg shadow focus:outline-none focus:shadow-outline text-gray-600 font-medium"
                    placeholder="Search Position...">
                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                        <circle cx="10" cy="10" r="7" />
                        <line x1="21" y1="21" x2="15" y2="15" />
                    </svg>
                </div>
            </div>
        </div>
		<div>

		</div>
        <div class="border-t-2 border-green-500">
            <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-md">
                <button onclick="openTab(event, 'tab1')" class="flex-1 py-2 px-4 rounded-md bg-green-600  text-white focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                    Cash Advance History
                </button>
                <button onclick="openTab(event, 'tab2')" class="flex-1 py-2 px-4 rounded-md focus:outline-none focus:shadow-outline-blue transition-all duration-300">
                    Total Cash Advance
                </button>
            </div>
            {{-- <nav class="flex">
                <a href="#" class="px-6 py-3 border-b-2 border-blue-500" onclick="openTab(event, 'tab1')">Tab 1</a>
                <a href="#" class="px-6 py-3" onclick="openTab(event, 'tab2')">Tab 2</a>
                <!-- Add more tabs as needed -->
            </nav> --}}

            <div id="tab1" class="tab-content">
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Requested Date
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Cash Advance
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Reason
                                    </th>
                                    {{-- <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider flex justify-center">
                                        Actions
                                    </th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashAdvance as $cash )
                                    <tr>
                                        <td class="px-5 py-5 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$cash->employee->user->firstName}} {{$cash->employee->user->lastName}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> {{ $cash->formattedRequestDate }}</p>
                                        </td>

                                        <td class="px-5 py-5 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> ₱ {{$cash->amount}}</p>
                                        </td>
                                        <td class="px-5 py-5 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> {{$cash->reason}}</p>
                                        </td>
                                        {{-- <td class="px-5 py-5 bg-white text-sm">
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">

                                                    <a  href="{{ url('/cash-advance/show', $cash->id) }}"  title="Show Position">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-gray-500 hover:scale-110">
                                                    <a href="{{ url('/cash-advance/edit', $cash->id) }}"  title="Edit Position">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>
                                                </div>

                                                <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                    <a href="#"  class="btn" title="Delete Position">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </td> --}}

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div
                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                            <span class="text-xs xs:text-sm text-gray-900">
                                Showing 1 to 4 of 50 Entries
                            </span>
                            <div class="inline-flex mt-2 xs:mt-0">
                                <button
                                    class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
                                    Prev
                                </button>
                                &nbsp; &nbsp;
                                <button
                                    class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
                                    Next
                                </button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div id="tab2" class="hidden tab-content">
                <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                        <table class="min-w-full leading-normal">
                            <thead>
                                <tr>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Name
                                    </th>
                                    <th
                                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                        Total Cash Advance
                                    </th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cashAdvanceTotal as $advance )
                                    <tr>
                                        <td class="px-5 py-5 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                    {{$advance->employee->user->firstName}} {{$advance->employee->user->lastName}}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>


                                        <td class="px-5 py-5 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap"> ₱ {{$advance->totalCashAdvance}}</p>
                                        </td>

                                        {{-- <td class="px-5 py-5 bg-white text-sm">
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">

                                                    <a  href="{{ url('/cash-advance/show', $cash->id) }}"  title="Show Position">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-gray-500 hover:scale-110">
                                                    <a href="{{ url('/cash-advance/edit', $cash->id) }}"  title="Edit Position">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>
                                                </div>

                                                <div class="w-4 mr-2 transform hover:text-red-500 hover:scale-110">
                                                    <a href="#"  class="btn" title="Delete Position">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </td> --}}

                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div
                            class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between          ">
                            <span class="text-xs xs:text-sm text-gray-900">
                                Showing 1 to 4 of 50 Entries
                            </span>
                            <div class="inline-flex mt-2 xs:mt-0">
                                <button
                                    class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-l">
                                    Prev
                                </button>
                                &nbsp; &nbsp;
                                <button
                                    class="text-sm text-indigo-50 transition duration-150 hover:bg-indigo-500 bg-indigo-600 font-semibold py-2 px-4 rounded-r">
                                    Next
                                </button>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <!-- Add more content for additional tabs -->
        </div>
	</div>
@endsection
<script>
    var lastClickedButton = document.querySelector('.bg-green-600');

    function openTab(event, tabName) {
        // Prevent default link behavior
        event.preventDefault();

        // Hide all tab contents
        var tabContents = document.getElementsByClassName('tab-content');
        for (var i = 0; i < tabContents.length; i++) {
            tabContents[i].style.display = 'none';
        }

        // Remove the 'bg-blue-600' class from the previously clicked button
        if (lastClickedButton) {
            lastClickedButton.classList.remove('bg-green-600');
            lastClickedButton.classList.remove('text-white');
        }

        // Show the selected tab content
        document.getElementById(tabName).style.display = 'block';

        // Add the 'bg-green-600' class to the clicked button
        event.target.classList.add('bg-green-600');
        event.target.classList.add('text-white');

        // Update the last clicked button
        lastClickedButton = event.target;
    }
</script>
