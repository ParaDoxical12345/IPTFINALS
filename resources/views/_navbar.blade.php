<!-- component -->
<nav class=" bg-blue-500 w-full flex relative justify-between items-center mx-auto px-8 h-20">
    <!-- logo -->
    <div class="inline-flex">
        <a class="_o6689fn" href="/"
            ><div class="hidden md:flex items-center">
                <img src="https://californiapayroll.com/wp-content/uploads/2022/01/payroll-banner-image.png" class="w-50 h-20" alt="Image">
                <h1 class="text-white text-3xl font-bold">PayDayPal</h1>
            </div>
        </a>
    </div>


        <div class="flex-initial">
            <div class="flex justify-end items-center relative">
                <div class="flex mr-4 items-center">
                    <a class="inline-block py-2 px-3 hover:bg-green-400 rounded-full" href="/dashboard">
                        <div class="flex items-center relative text-white  cursor-pointer whitespace-nowrap">Dashboard</div>
                    </a>
                    @if(auth()->user()->hasRole('admin'))
                        <a class="inline-block py-2 px-3 hover:bg-green-400 rounded-full" href="/positions">
                            <div class="flex items-center relative text-white  cursor-pointer whitespace-nowrap">Positions</div>
                        </a>
                        <a class="inline-block py-2 px-3 hover:bg-green-400 rounded-full" href="/employees">
                            <div class="flex items-center relative text-white  cursor-pointer whitespace-nowrap">Employee</div>
                        </a>

                        <a class="inline-block py-2 px-3 hover:bg-green-400  rounded-full" href="/cash-advance">
                            <div class="flex items-center relative text-white  cursor-pointer whitespace-nowrap">Cash Advance</div>
                        </a>
                        <a class="inline-block py-2 px-3 hover:bg-green-400  rounded-full" href="/payroll">
                            <div class="flex items-center relative  text-white cursor-pointer whitespace-nowrap">Payroll</div>
                        </a>
                    @endif

                    @if(auth()->user()->hasRole('employee'))
                        <a class="inline-block py-2 px-3 hover:bg-green-400  rounded-full" href="/cashAdvance">
                            <div class="flex items-center relative text-white  cursor-pointer whitespace-nowrap">Cash Advance</div>
                        </a>
                        <a class="inline-block py-2 px-3 hover:bg-green-400  rounded-full" href="/payroll">
                            <div class="flex items-center relative  text-white cursor-pointer whitespace-nowrap">Pay slip</div>
                        </a>
                    @endif

                    <a class="inline-block py-2 px-3 hover:bg-green-400 rounded-full" href="/logs">
                            <div class="flex items-center relative text-white  cursor-pointer whitespace-nowrap">Logs</div>
                        </a>

                </div>

                <div class="flex justify-end items-center relative">
                    <form action="{{url('/logout')}}" method="POST" class="inline-block py-2 px-3 hover:bg-green-400 rounded-full">
                        {{csrf_field()}}
                        <button class="flex items-center relative  text-white cursor-pointer whitespace-nowrap"  type="submit">Logout</button>
                    </form>
                    {{-- <a class="inline-block py-2 px-3 hover:bg-green-400 rounded-full" href="/positions">
                        <div class="flex items-center relative text-white  cursor-pointer whitespace-nowrap">Logout</div>
                    </a> --}}

                </div>
            </div>
        </div>
    </div>
    <!-- end login -->
</nav>

<style scoped>

</style>
