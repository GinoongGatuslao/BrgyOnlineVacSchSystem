<div>
    <x-slot name="header">
       <span class="p-2"> {{ __('View patient Information') }}</span>
    </x-slot>

    <div class="py-3 rounded-lg bg-gradient-to-b from-white to-gray-100 drop-shadow-xl">
        <div class="items-center w-full h-full mb-5 space-y-3">
            <section id="header" class="block space-y-5 text-left">
                <h1 class="px-4 py-2 text-4xl font-extrabold tracking-wider text-blue-600 uppercase">Patient Information</h1>
                <div class="flex w-full px-3 mx-auto text-center">
                    <div class="container py-10 rounded-lg bg-gradient-to-b from-white to-gray-100 ">
                        <div
                            class="max-w-3xl px-4 mx-auto sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
                            <div class="flex items-center space-x-5">
                                <div class="flex-shrink-0">
                                    <div class="relative">
                                        @if ($photo_url != 'none')
                                        <img src="{{asset('storage/'.$photo_url) }}" alt="as" class="h-16 w-16 rounded-full">
                                        @else
                                            @if ($patient->sex == 'Male')
                                            <x-male-avatar width="400" class="w-16 h-auto text-black fill-current " />
                                            @else
                                            <x-female-avatar width="400" class="w-16 h-auto text-black fill-current" />
                                            @endif
                                        @endif
                                        <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <h1 class="text-xl font-extrabold text-gray-900 md:font-bold md:text-2xl">{{ $user->name }}</h1>
                                    <p class="text-xs font-bold text-gray-600 md:font-medium md:text-sm">Prk. {{ $patient->purok->name }}, Baranggay New Carmen, Tacurong City, Sultan Kudarat</p>
                                    <p class="text-xs font-bold text-gray-600 md:font-medium md:text-sm">{{ Carbon\Carbon::parse($patient->birthdate)->age }} years old | {{ $patient->sex }}</p>
                                </div>
                            </div>
                        </div>
                    
                        <div
                            class="grid gap-6 mx-auto mt-8 text-left max-w-7xl">
                            <div class="space-y-6 ">
                                <!-- Description list-->
                                <section aria-labelledby="applicant-information-title">
                                    <div class="bg-gray-100 sm:rounded-lg">
                                        <div class="px-4 py-5 bg-gray-100 sm:px-6">
                                            <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">
                                                Personal Information</h2>
                                            <p class="max-w-2xl mt-1 text-sm text-gray-500">Personal details and current vaccination status.</p>
                                        </div>
                                        <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
                                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Vaccination Status</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">Unvaccinated</dd>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">{{ $user->email }}</dd>
                                                </div>
                                                <div class="sm:col-span-1">
                                                    <dt class="text-sm font-medium text-gray-500">Mobile Phone</dt>
                                                    <dd class="flex items-start mt-1 text-sm text-gray-900">
                                                       <span class="italic tracking-wider"> (+63){{ substr($patient->contact_number,-10) }}</span>
                                                        <span class="flex my-auto ml-1 text-xs italic tracking-widest text-gray-400">
                                                            @if ($patient->contact_number_verified == 'verified')
                                                            <div class="flex items-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-auto text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                              </svg>
                                                              <span class="my-auto italic font-bold text-blue-500">Verified</span>
                                                            </div>
                                                            @else
                                                            Unverified                                                                                
                                                            @endif
                                                        </span></dd>
                                                        @if ($patient->contact_number_verified == 'unverified')
                                                            @livewire('client.components.verify', ['patient' => $patient])                                                                           
                                                        @endif
                                                    
                                                </div>
                                                <div class="sm:col-span-2">
                                                    <dt class="text-sm font-medium text-gray-500">Vaccination Schedules</dt>
                                                    <dd class="mt-1 text-sm text-gray-900">
                                                      @if ($appointments->count()>0)
                                                        @if($appointments->count() > 1)
                                                        <div class="items-start md:columns-2">
                                                        @else
                                                        <div class="items-start">
                                                        @endif
                                                            @foreach ($appointments as $appointment)
                                                                <div class="p-3 mx-4 my-2 font-semibold text-center text-blue-600 bg-green-200 border border-green-100 rounded-lg shadow-md md:p-10 shadow-green-500">
                                                                    <p class="text-lg font-bold md:text-3xl">{{ Carbon\Carbon::parse($appointment->appointmentDate->date)->format('F d, Y') }}</p>
                                                                    <p class="font-bold text-md md:text-2xl">Time Slot: {{ $appointment->appointmentTime->time_slot }}</p>
                                                                    <p class="text-sm font-bold md:text-xl">Vaccine: {{ $appointment->vaccine->vaccine_name }}</p>
                                                                    @if ($appointment->appointment_type_id == 1)
                                                                    <p class="text-sm font-bold md:text-xl">First Dose</p>
                                                                    @else
                                                                    <p class="text-sm font-bold md:text-xl">Second Dose</p>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                      @else
                                                          <span class="pl-2 text-sm italic font-bold tracking-wide text-gray-700 uppercase">No Vaccination Schedule Found! <a href="{{ route('schedule-vaccination') }}" class="text-blue-600 underline hover:cursor-pointer hover:text-lg">Schedule One</a> Now!</span>
                                                      @endif
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </section>
                            </div>
                    
                        </div>
                    </div>
                    
                </div>
            </section>
        </div>
    </div>
</div>