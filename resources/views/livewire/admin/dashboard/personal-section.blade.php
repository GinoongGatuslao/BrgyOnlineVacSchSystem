<div class="py-5 bg-white rounded-lg">
    <div class="h-full w-full items-center space-y-3">
        <section id="header" class="block text-center space-y-5">
            <h1 class="text-4xl tracking-wider font-extrabold uppercase text-indigo-600">Reports</h1>
            <div class="flex mx-auto w-full text-center px-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-auto w-4 text-indigo-600 hover:text-gray-600 hover:cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-3xl mx-auto"> {{ $currentMonth }} {{ $currentYear }}</span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-auto w-4 text-indigo-600 hover:text-gray-600 hover:cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </section>
        <div class="grid grid-cols-7 p-5 shadow-md mx-3 rounded-lg shadow-indigo-300">
            <div class="col-span-1 bg-blue-300 text-white text-center rounded-tl-lg font-bold tracking-wide text-xl">
                <span class="m-auto">Sunday</span>
            </div>
            <div class="col-span-1 bg-blue-300 text-white text-center font-bold tracking-wide text-xl">
                <span class="m-auto">Monday</span>
            </div>
            <div class="col-span-1 bg-blue-300 text-white text-center font-bold tracking-wide text-xl">
                <span class="m-auto">Tuesday</span>
            </div>
            <div class="col-span-1 bg-blue-300 text-white text-center font-bold tracking-wide text-xl">
                <span class="m-auto">Wednesday</span>
            </div>
            <div class="col-span-1 bg-blue-300 text-white text-center font-bold tracking-wide text-xl">
                <span class="m-auto">Thursday</span>
            </div>
            <div class="col-span-1 bg-blue-300 text-white text-center font-bold tracking-wide text-xl">
                <span class="m-auto">Friday</span>
            </div>
            <div class="col-span-1 bg-blue-300 text-white text-center rounded-tr-lg font-bold tracking-wide text-xl">
                <span class="m-auto">Saturday</span>
            </div>

        </div>
    </div>
</div>
