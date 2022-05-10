<div class="py-3 bg-white rounded-lg drop-shadow-xl" x-data="{showSearchModal : false}">
    <div class="items-center w-full h-full mb-5 space-y-3">
        <section id="header" class="block space-y-5 text-center">
            <h1 class="text-4xl font-extrabold tracking-wider text-blue-600 uppercase">Reports ({{ $dateToday }})</h1>
            <div class="flex w-full px-3 mx-auto text-center">

                {{-- <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-auto text-blue-600 hover:text-gray-600 hover:cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="mx-auto text-3xl"></span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-auto text-blue-600 hover:text-gray-600 hover:cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg> --}}
            </div>
        </section>
        <section id="body" class="flextext-center">
            <div class="flex mx-auto columns-2">
                <div id="timetable"
                    class="h-full grid-flow-row pt-2 overflow-y-auto text-right border-r-4 border-gray-400 divide-y-2 divide-gray-200 max-h-screen-80">
                    <div
                        class="w-full py-3 pl-10 pr-5 text-2xl font-extrabold tracking-wider border-b-4 border-gray-400">
                        <span class="italic text-left uppercase">Time Slots</span></div>
                    @foreach ($tslots as $tslot)
                    <div class="py-3 pl-10 pr-5 text-xl font-bold tracking-wider w-fit group hover:cursor-pointer hover:bg-gray-200"
                        wire:click='getAppointments({{ $tslot->id }})'><span
                            class="text-right group-hover:italic">{{ $tslot->time_slot }}</span></div>
                    @endforeach
                </div>
                <div id="patientlist"
                    class="grid w-full h-full grid-flow-row grid-cols-2 pt-2 text-center max-w-screen-60 ">
                    <div class="grid grid-cols-3 col-span-2">
                        <div class="col-span-1 p-2 text-left border-b-4 border-gray-400">
                            <div class="py-1 pl-5 text-2xl font-extrabold tracking-wider"><span
                                    class="italic text-left uppercase">Patient List</span></div>
                        </div>
                        <div class="col-span-1 p-2 text-left border-b-4 border-gray-400">
                            <div class="flex items-center w-full">
                                <input type="text" class="w-full rounded-full text-md"
                                    placeholder="Search patient's name here" wire:model="searchterm">
                            </div>
                        </div>
                        <div class="col-span-1 p-2 text-left border-b-4 border-gray-400">
                            <div class="grid items-center w-full grid-cols-3 grid-rows-2">
                                <div class="col-span-1 col-start-1 row-span-1 row-start-1">
                                    <p class="text-sm"> <strong class="text-black">Available Slots:</strong>
                                        {{ $available_slots }} </p>
                                </div>
                                <div class="col-span-1 col-start-2 row-span-1 row-start-1">
                                    <p class="text-sm"> <strong class="text-black">Total Slots:</strong>
                                        {{ $total_slots }} </p>
                                </div>
                                <div class="col-span-1 col-start-1 row-span-1 row-start-2">
                                    <p class="text-sm"> <strong class="text-black">Occupied Slots:</strong>
                                        {{ $occupied_slots }} </p>
                                </div>
                                <div class="col-span-1 col-start-2 row-span-1 row-start-2">
                                    <p class="text-sm"> <strong class="text-black">Vaccine:</strong> {{ $vaccine_name }}
                                    </p>
                                </div>
                                <div class="col-span-1 col-start-3 row-span-2 row-start-1">
                                    <button
                                        class="w-auto h-full px-4 py-2 m-2 text-white bg-blue-400 hover:text-blue-800 hover:bg-slate-300 rounded-2xl"
                                        type="button" x-on:click="showSearchModal = true">Search All</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-3 p-5 ">

                            <div class="flex flex-col">
                                <div class="overflow-x-auto overflow-y-auto max-h-screen-30">
                                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                                <tr>
                                                    <th scope="col"
                                                        class="py-3.5 pl-4 pr-3 text-left text-lg font-semibold text-gray-900 sm:pl-6 md:pl-0">
                                                        #</th>
                                                    <th scope="col"
                                                        class="py-3.5 px-3 text-left text-lg font-semibold text-gray-900">
                                                        Patient Name</th>
                                                    <th scope="col"
                                                        class="py-3.5 px-3 text-left text-lg font-semibold text-gray-900">
                                                        Age</th>
                                                    <th scope="col"
                                                        class="py-3.5 px-3 text-left text-lg font-semibold text-gray-900">
                                                        Purok</th>
                                                    <th scope="col"
                                                        class="py-3.5 px-3 text-left text-lg font-semibold text-gray-900">
                                                        Sex</th>
                                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 md:pr-0">
                                                        <span class="sr-only">View</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">

                                                {{-- if $apppointments is not empty echo $apppointments --}}
                                                @if (count($appointments) > 0)
                                                @foreach ($appointments as $key => $appointment)
                                                <tr class="text-left">
                                                    <td
                                                        class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6 md:pl-0">
                                                        {{ $key+1 }}</td>
                                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $appointment->patient->first_name }}
                                                        {{ $appointment->patient->middle_name }}
                                                        {{ $appointment->patient->last_name }}</td>
                                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ Carbon\Carbon::parse($appointment->patient->birthdate)->age }}
                                                        years old</td>
                                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $appointment->patient->purok->name }}</td>
                                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">
                                                        {{ $appointment->patient->sex }}</td>
                                                    <td
                                                        class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6 md:pr-0">
                                                        <a href="{{ route('view-patient-information',['patient_id'=>$appointment->patient_id]) }}"
                                                            class="text-blue-600 hover:text-blue-900">View<span
                                                                class="sr-only">,
                                                                {{ $appointment->patient->first_name }}
                                                                {{ $appointment->patient->middle_name }}
                                                                {{ $appointment->patient->last_name }}</span></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @else
                                                <tr class="hover:bg-gray-200">
                                                    <td class="py-3.5 pl-4 pr-3 italic text-lg font-semibold text-gray-500 sm:pl-6 md:pl-0 text-center"
                                                        colspan="3">No Appointments</td>
                                                </tr>
                                                @endif




                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
        </section>
    </div>
    {{-- modal start --}}
    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-cloak x-show="showSearchModal">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-10 backdrop-blur-md" aria-hidden="true"
                x-cloak x-show="showSearchModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!--
            Modal panel, show/hide based on modal state.
    
            Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
            Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
            <div x-cloak x-show="showSearchModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl shadow-blue-800/50 sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div>
                    <div class="mt-3 text-center sm:mt-5">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Search Patient</h3>
                        <div class="mt-2">
                            <input type="text" wire:model="searchtermModal"
                                class="block w-full text-indigo-500 border border-blue-300 text-md bg-slate-100 rounded-xl">
                        </div>
                        @if (count($appointmentsModal) > 1 && $searchtermModal != "")
                        <div class="grid grid-cols-2 p-2 mt-2 bg-slate-100 rounded-xl">
                            @foreach ($appointmentsModal as $appointment_info)
                            <div class="container col-span-1 p-2 text-left text-slate-700">
                                <p class="text-md">
                                    {{ $appointment_info->patient->first_name }}
                                    {{ $appointment_info->patient->middle_name }}
                                    {{ $appointment_info->patient->last_name }}
                                </p>
                                <p class="pl-2 text-sm">
                                    {{ $appointment_info->patient->sex}} /
                                    {{ Carbon\Carbon::parse($appointment_info->patient->birthdate)->age }} years old
                                </p>
                                <p class="pl-2 text-sm">
                                    Purok {{ $appointment_info->patient->purok->name }}
                                </p>
                                <p class="pl-2 text-sm">
                                    <a href="{{ route('view-patient-information',['patient_id'=>$appointment_info->patient_id]) }}"
                                        class="text-blue-600 hover:text-blue-900">More details >>></a>
                                </p>
                            </div>

                            @endforeach
                        </div>
                        @else
                        @if (count($appointmentsModal) < 1 && $searchtermModal !="" ) <div
                            class="flex p-2 mt-2 bg-slate-100 rounded-xl">
                            <span class="py-4 mx-auto text-xl text-slate-400">No patient(s) found with
                                "{{ $searchtermModal }}"</span>
                    </div>
                    @elseif ((count($appointmentsModal) > 0 && $searchtermModal != ""))
                    <div class="flex p-2 mt-2 bg-slate-100 rounded-xl">
                        @foreach ($appointmentsModal as $appointment_info)
                        <div class="container p-2 text-left text-slate-700">
                            <p class="text-md">
                                {{ $appointment_info->patient->first_name }}
                                {{ $appointment_info->patient->middle_name }}
                                {{ $appointment_info->patient->last_name }}
                            </p>
                            <p class="pl-2 text-sm">
                                {{ $appointment_info->patient->sex}} /
                                {{ Carbon\Carbon::parse($appointment_info->patient->birthdate)->age }} years old
                            </p>
                            <p class="pl-2 text-sm">
                                Purok {{ $appointment_info->patient->purok->name }}
                            </p>
                            <p class="pl-2 text-sm">
                                <a href="{{ route('view-patient-information',['patient_id'=>$appointment_info->patient_id]) }}"
                                    class="text-blue-600 hover:text-blue-900">More details >>></a>
                            </p>
                        </div>

                        @endforeach
                    </div>
                    @endif
                    @endif

                </div>
            </div>
            <div class="mt-5 sm:mt-6 :gap-3 sm:grid-flow-row-dense">

                <button type="button" x-on:click="showSearchModal = false"
                    class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:col-start-1 sm:text-sm">Close</button>
            </div>
        </div>
    </div>
</div>

