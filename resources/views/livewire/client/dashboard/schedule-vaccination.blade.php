<div class="container" x-data="{showConfirmModal : @entangle('showConfirmModal'), showSuccessModal : @entangle('showSuccessModal')}">
    <x-slot name="header">
        Schedule Vaccination
    </x-slot>
    <div class="py-10 bg-white rounded-lg shadow-lg min-w-fit shadow-slate-400/40">
        <h1 class="m-5 -mt-5 text-lg font-bold text-blue-600 md:text-3xl">Upcoming Vaccination Schedules</h1>
        @if ($appointmentdates->count() > 0)
            @if ($appointments != 0)
            <h1 class="mx-5"><span class="text-lg italic font-bold tracking-wider text-gray-600">We believe you've already scheduled your vaccination. Check <a href="{{ route('dashboard-home') }}" class="italic text-blue-500 underline"> your dashboard</a>.</span></h1>
            @else
            <div class="grid w-auto h-auto grid-cols-1 gap-5 py-5 mx-5 overflow-y-auto md:grid-cols-4 max-h-screen-90" wire:key='dates_table'>
                @foreach ($appointmentdates as $appointment)
                <div x-data="{open{{ $appointment->id }}:false}" class="col-span-1 group hover:cursor-pointer" wire:click="showConfirmModal({{ $appointment->id }})" wire:key='{{ $loop->index }}'>
                    <div class="flex items-start w-auto h-auto p-4 text-center bg-green-200 border-2 border-black rounded-lg shadow-lg shadow-slate-400/50" @mouseover="open{{ $appointment->id }} = true"  @mouseleave="open{{ $appointment->id }} = false">
                        <div class="mx-auto text-center">
                            <p class="text-lg font-extrabold tracking-wide text-center" id="date">{{ Carbon\Carbon::parse($appointment->date)->format('F Y') }}</p>
                            <span class="font-extrabold tracking-wide text-center text-7xl" id="date">{{ Carbon\Carbon::parse($appointment->date)->format('d') }}</span>
                        </div>
                        <div class="m-auto" x-cloak x-show="open{{ $appointment->id }}" >
                            <p class="text-lg font-semibold text-gray-600">Available Slots: </p>
                            <span class="text-3xl font-semibold text-green-700">{{ $appointment->available_slots }}</span>
                            <p class="text-lg font-semibold text-gray-600">Vaccine: </p>
                            <span class="text-3xl font-semibold text-green-700">{{ $appointment->vaccine->vaccine_name }}</span>
                        </div>
                          
                    </div>
                    <div class="flex items-start float-right mx-3 my-1 text-right text-blue-400" x-cloak x-show="open{{ $appointment->id }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-auto my-auto" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                        <span class="my-auto text-xs font-bold">Click box to set vaccination schedule</span>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        @else
        <h1 class="mx-5"><span class="text-lg italic font-bold tracking-wider text-gray-600">There are no available schedules for vaccination at the time. Check back next time :)</span></h1>
        @endif
    </div>
    {{-- confirm modal --}}
    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak
            x-show="showConfirmModal">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                <div x-transition-enter="ease-out duration-300" x-transition-enter-start="opacity-0"
                    x-transition-enter-end="opacity-100" x-transition-leave="ease-in duration-200"
                    x-transition-leave-start="opacity-100" x-transition-leave-end="opacity-0"
                    class="fixed inset-0 transition-opacity bg-opacity-75" aria-hidden="true" x-cloak x-show="showConfirmModal">
                </div>

                <!-- This element is to trick the browser into centering the modal contents. -->
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div x-transition-enter="ease-out duration-300"
                    x-transition-enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition-enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition-leave="ease-in duration-200"
                    x-transition-leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition-leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-cloak
                    x-show="showConfirmModal" @click.away="showConfirmModal=false"
                    class="absolute inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6 sm:relative">
                    <div>
                        @if ($patient->contact_number_verified=='verified')
                        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full">
                            <!-- Heroicon name: outline/check -->

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-700" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Confirm Vaccination
                                Schedule</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Would you like to set up a vaccination schedule for <strong class="italic">{{ isset($selectedDate->date ) ? Carbon\Carbon::parse($selectedDate->date)->format('F d, Y'):'' }}?</strong></p>
                                </div>
                                <div class="items-center block mt-4">
                                    <p class="font-bold tracking-wider text-blue-500 text-md">Select Time Slot:</p>
                                    <select name="vaccines" id="vaccines" class="w-full px-3 py-1 mx-2 my-1 rounded-lg text-md group hover:cursor-pointer" wire:model="apTimeID">
                                        @foreach ($appointmentTimes as $appointmentTime)
                                        @if ($appointmentTime->available_slots > 0)
                                            <option class="p-1 m-1 text-sm hover:bg-blue-100 group-hover:cursor-pointer" value="{{ $appointmentTime->id }}">{{ $appointmentTime->time_slot }}</option> 
                                            @else
                                            <option class="p-1 m-1 text-sm hover:bg-blue-100 group-hover:cursor-pointer" disabled value="{{ $appointmentTime->id }}">{{ $appointmentTime->time_slot }}</option>  
                                            @endif)                                   
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        @else
                        <div class="flex items-center justify-center mx-auto rounded-full">
                            <!-- Heroicon name: outline/check -->

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-auto text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                              </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-5">
                            <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Contact Number Unverified</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Your contact number hasn't been verified yet. To set a schedule please verify it first.</p>
                                    <p class="text-gray-500 text-md"><strong class="italic">Thank you!</strong></p>
                                </div>
                        </div>
                        @endif
                       
                    </div>
                    <div class="mt-5 sm:mt-6 sm:grid sm:grid-cols-2 sm:gap-3 sm:grid-flow-row-dense">
                        @if ($patient->contact_number_verified=='verified')
                        <button type="button" wire:click='setAppointmentSchedule'
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm">Set
                            Schedule</button>
                        @else
                        <a href="/"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:col-start-2 sm:text-sm">Verify Contact Number</a>
                        @endif

                        <button type="button" x-on:click="showConfirmModal=false"
                            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:col-start-1 sm:text-sm">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    {{-- success modal --}}
        <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak x-show="showSuccessModal">
            <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-transition-enter = "ease-out duration-300"
            x-transition-enter-start =  "opacity-0"
            x-transition-enter-end =  "opacity-100"
            x-transition-leave =  "ease-in duration-200"
            x-transition-leave-start =  "opacity-100"
            x-transition-leave-end ="opacity-0"   class="fixed inset-0 transition-opacity bg-opacity-75" aria-hidden="true" x-cloak x-show="showSuccessModal"></div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-transition-enter = "ease-out duration-300"
            x-transition-enter-start =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition-enter-end =  "opacity-100 translate-y-0 sm:scale-100"
            x-transition-leave =  "ease-in duration-200"
            x-transition-leave-start =  "opacity-100 translate-y-0 sm:scale-100"
            x-transition-leave-end = "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"  x-cloak x-show="showSuccessModal" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6">
                <div>
                <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
                    <!-- Heroicon name: outline/check -->
                    <svg class="w-6 h-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="mt-3 text-center sm:mt-5">
                    <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Vaccination Schedule Set Up Successful</h3>
                    <div class="mt-2">
                    <p class="text-sm text-gray-500">Vaccination Schedule for  has been set successfully!</p>
                    </div>
                </div>
                </div>
                <div class="mt-5 sm:mt-6">
                <a  href="" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Got it!</a>
                </div>
            </div>
            </div>
        </div>
</div>
