<div class="py-3 bg-white rounded-lg drop-shadow-xl">
    <div class="items-center w-full h-full mb-5 space-y-3">
        <section id="header" class="block space-y-5 text-center">
            <h1 class="text-4xl font-extrabold tracking-wider text-indigo-600 uppercase">Reports</h1>
            <div class="flex w-full px-3 mx-auto text-center">

                {{-- <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-auto text-indigo-600 hover:text-gray-600 hover:cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="mx-auto text-3xl"></span>
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-auto text-indigo-600 hover:text-gray-600 hover:cursor-pointer" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg> --}}
            </div>
        </section>
        <section id="body" class="flextext-center">
            <div class="flex mx-auto columns-2">
                <div id="timetable" class="h-full grid-flow-row pt-2 overflow-y-auto text-right border-r-4 border-gray-400 divide-y-2 divide-gray-200 max-h-screen-80">
                    <div class="w-full py-3 pl-10 pr-5 text-2xl font-extrabold tracking-wider border-b-4 border-gray-400"><span class="italic text-left uppercase">Time Slots</span></div>
                    @foreach ($tslots as $tslot)
                        <div class="py-3 pl-10 pr-5 text-xl font-bold tracking-wider w-fit group hover:cursor-pointer hover:bg-gray-200" wire:click='getAppointments({{ $tslot->id }})'><span class="text-right group-hover:italic">{{ $tslot->time_slot }}</span></div>
                    @endforeach
                </div>
                <div id="patientlist" class="grid w-full h-full grid-flow-row grid-cols-2 pt-2 text-center max-w-screen-60 ">
                    <div class="grid grid-cols-3 col-span-2">
                        <div class="col-span-1 p-2 text-left border-b-4 border-gray-400">
                            <div class="py-1 pl-5 text-2xl font-extrabold tracking-wider"><span class="italic text-left uppercase">Patient List</span></div>
                        </div>
                        <div class="col-span-1 p-2 text-left border-b-4 border-gray-400">
                            <div class="flex items-center w-full">
                                <input type="text" class="w-full rounded-full text-md" placeholder="Search patient's name here" wire:model="searchterm">
                            </div>
                        </div>
                        <div class="col-span-1 p-2 text-left border-b-4 border-gray-400">
                            <div class="grid items-center w-full grid-cols-2 grid-rows-2">
                                <div><p class="text-sm"> <strong class="text-black">Available Slots:</strong> {{ $available_slots }} </p></div>
                                <div><p class="text-sm"> <strong class="text-black">Total Slots:</strong> {{ $total_slots }} </p></div>
                                <div><p class="text-sm"> <strong class="text-black">Occupied Slots:</strong> {{ $occupied_slots }} </p></div>
                                <div><p class="text-sm"> <strong class="text-black">Vaccine:</strong> {{ $vaccine_name }} </p></div>
                            </div>
                        </div>
                        <div class="col-span-3 p-5 ">
                            
                            <div class="flex flex-col">
                                <div class="overflow-x-auto overflow-y-auto max-h-screen-30">
                                  <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                    <table class="min-w-full divide-y divide-gray-300">
                                      <thead>
                                        <tr>
                                          <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-lg font-semibold text-gray-900 sm:pl-6 md:pl-0">#</th>
                                          <th scope="col" class="py-3.5 px-3 text-left text-lg font-semibold text-gray-900">Patient Name</th>
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
                                                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6 md:pl-0">{{ $key+1 }}</td>
                                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $appointment->patient->first_name }} {{ $appointment->patient->middle_name }} {{ $appointment->patient->last_name }}</td>
                                                    <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6 md:pr-0">
                                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">View<span class="sr-only">, Name</span></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="hover:bg-gray-200" >
                                                <td class="py-3.5 pl-4 pr-3 italic text-lg font-semibold text-gray-500 sm:pl-6 md:pl-0 text-center" colspan="3">No Appointments</td>
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
</div>
