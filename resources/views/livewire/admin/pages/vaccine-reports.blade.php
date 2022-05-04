<div>
    <x-slot name="header">
        {{ __('Reports') }}
    </x-slot>

    <div class="container p-10 bg-white drop-shadow-xl rounded-xl">
        <div class="w-auto text-indigo-700 max-h-screen-80 md:h-screen-30">
            <div class="rows-2">
                {{-- filter list --}}
                <div class="items-start block p-10 bg-red-500">

                </div>
                {{-- end filter list --}}

                {{-- table--}}
                <div class="block h-full bg-gray-50">

                    <div class="px-4 sm:px-6 lg:px-8">

                        <div class="flex flex-col mt-2">
                            <div class="-mx-4 -my-2 sm:-mx-6 lg:-mx-8">
                                <div class="flex justify-end min-w-full pt-2 pb-1 ">
                                    <div class="flex pr-2 ">
                                        <p
                                            class="my-auto ml-3 mr-2 text-lg font-extrabold text-right uppercase text-slate-800">
                                            Search name:</p>
                                        <input wire:model="search_name" type="text" name="" id=""
                                            class="my-auto text-sm rounded-2xl w-80 focus:ring-2 focus:ring-offset-1 focus:ring-blue-200">
                                    </div>
                                </div>
                                <div class="inline-block min-w-full py-2 align-middle ">
                                    <div
                                        class="overflow-y-auto shadow-sm ring-1 ring-black ring-opacity-5 h-80 rounded-xl ">
                                        <table class="min-w-full border-separate " style="border-spacing: 0">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:pl-6 lg:pl-8">
                                                        <a href="#" class="inline-flex group">
                                                            Name
                                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                                            <span
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">
                                                        Sex
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter sm:table-cell">
                                                        <a href="#" class="inline-flex group">
                                                            Purok
                                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                                            <span
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 hidden border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter lg:table-cell">
                                                        <a href="#" class="inline-flex group">
                                                            Date
                                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                                            <span
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                                        <a href="#" class="inline-flex group">
                                                            Time Slot
                                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                                            <span
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </a></th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                                        <a href="#" class="inline-flex group">
                                                            Vaccine
                                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                                            <span
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </a></th>
                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 px-3 py-3.5 text-left text-sm font-semibold text-gray-900 backdrop-blur backdrop-filter">
                                                        <a href="#" class="inline-flex group">
                                                            Type
                                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                                            <span
                                                                class="flex-none ml-2 text-gray-900 bg-gray-200 rounded group-hover:bg-gray-300">
                                                                <!-- Heroicon name: solid/chevron-down -->
                                                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                                                    viewBox="0 0 20 20" fill="currentColor"
                                                                    aria-hidden="true">
                                                                    <path fill-rule="evenodd"
                                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                        </a></th>

                                                    <th scope="col"
                                                        class="sticky top-0 z-10 border-b border-gray-300 bg-gray-50 bg-opacity-75 py-3.5 pr-4 pl-3 backdrop-blur backdrop-filter sm:pr-6 lg:pr-8">
                                                        <span class="sr-only">View</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white ">
                                                <tr>
                                                    <td
                                                        class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 border-b border-gray-200 whitespace-nowrap sm:pl-6 lg:pl-8">
                                                        Lindsay Walton</td>
                                                    <td
                                                        class="hidden px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap sm:table-cell">
                                                        Front-end Developer</td>
                                                    <td
                                                        class="hidden px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap lg:table-cell">
                                                        lindsay.walton@example.com</td>
                                                    <td
                                                        class="px-3 py-4 text-sm text-gray-500 border-b border-gray-200 whitespace-nowrap">
                                                        Member</td>
                                                    <td
                                                        class="relative py-4 pl-3 pr-4 text-sm font-medium text-right border-b border-gray-200 whitespace-nowrap sm:pr-6 lg:pr-8">
                                                        <a href="#"
                                                            class="text-indigo-600 hover:text-indigo-900">Edit<span
                                                                class="sr-only">, Lindsay Walton</span></a>
                                                    </td>
                                                </tr>

                                                <!-- More people... -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                {{-- end table--}}
            </div>
        </div>
    </div>
</div>
