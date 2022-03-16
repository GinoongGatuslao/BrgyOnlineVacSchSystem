<div class="container py-10 bg-white rounded-lg shadow-lg shadow-slate-400/40">
    <div
        class="max-w-3xl px-4 mx-auto sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
        <div class="flex items-center space-x-5">
            <div class="flex-shrink-0">
                <div class="relative">
                    <img class="w-16 h-16 rounded-full"
                        src="https://images.unsplash.com/photo-1463453091185-61582044d556?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80"
                        alt="">
                    <span class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></span>
                </div>
            </div>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
                <p class="text-sm font-medium text-gray-500">Prk. {{ $patient->purok->name }}, Baranggay New Carmen, Tacurong City, Sultan Kudarat</p>
                <p class="text-sm font-medium text-gray-500">{{ Carbon\Carbon::parse($patient->birthdate)->age }} years old | {{ $patient->sex }}</p>
            </div>
        </div>
    </div>

    <div
        class="grid gap-6 mx-auto mt-8 max-w-7xl ">
        <div class="space-y-6 ">
            <!-- Description list-->
            <section aria-labelledby="applicant-information-title">
                <div class="bg-white shadow-sm shadow-gray-500 sm:rounded-lg">
                    <div class="px-4 py-5 bg-gray-100 sm:px-6">
                        <h2 id="applicant-information-title" class="text-lg font-medium leading-6 text-gray-900">
                            Personal Information</h2>
                        <p class="max-w-2xl mt-1 text-sm text-gray-500">Personal details and current .</p>
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
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">(+63) {{ $patient->contact_number }}
                                    <span class="text-xs italic tracking-widest text-gray-400">
                                        @if ($patient->contact_number_verified == Hash::make($patient->user_id.'YES'))
                                        Verified
                                        @else
                                        Unverified                                                                                
                                        @endif
                                    </span></dd>
                                    @if ($patient->contact_number_verified != Hash::make($patient->user_id.'YES'))
                                        @livewire('client.components.verify', ['patient' => $patient])                                                                           
                                    @endif
                                
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-500">Vaccination Schedules</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                  @if (isset($appointments))
                                    
                                  @else
                                      <span class="pl-2 text-sm italic font-bold tracking-wide text-gray-700 uppercase">No Vaccination Schedule Found! <a href="{{ route('schedule-vaccination') }}" class="text-indigo-600 underline hover:cursor-pointer hover:text-lg">Schedule One</a> Now!</span>
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
