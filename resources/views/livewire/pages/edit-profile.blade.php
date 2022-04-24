<div class="container py-10 rounded-lg shadow-lg bg-gradient-to-b from-white to-gray-100 shadow-slate-400/40 ">
    <x-slot name="header">
        {{ __('Manage Profile') }}
    </x-slot>
    <div
        class="max-w-3xl px-4 mx-auto sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
        <div class="flex items-center space-x-5">
            <div class="flex-shrink-0">
                <div class="relative rounded-full group">
                    @if ($patient->sex == 'Male')
                    <x-male-avatar width="400" class="w-16 h-auto text-black fill-current" />
                    @else
                    <x-female-avatar width="400" class="w-16 h-auto text-black fill-current" />
                    @endif
                    <div class="absolute inset-0 text-center rounded-full shadow-inner" aria-hidden="true">
                       
                    </div>
                    <div class="relative z-50 hidden text-center bg-red-500 group-hover:block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-center text-blue-500 opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                </div>       
               
            </div>
            <div>
                <h1 class="text-xl font-extrabold text-gray-900 md:font-bold md:text-2xl">{{ auth()->user()->name }}</h1>
                <p class="text-xs font-bold text-gray-600 md:font-medium md:text-sm">@if($user->user_type_id ==1)
                    {{ $patient->address }}
                @else
                Prk. {{ $patient->purok->name }} , Baranggay New Carmen, Tacurong City, Sultan Kudarat
                @endif</p>
                <p class="text-xs font-bold text-gray-600 md:font-medium md:text-sm">{{ Carbon\Carbon::parse($patient->birthdate)->age }} years old | {{ $patient->sex }}</p>
            </div>
        </div>
    </div>

    <div
        class="grid gap-6 mx-auto mt-8 max-w-7xl ">
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
                        </dl>
                    </div>
                </div>
            </section>
        </div>

    </div>
</div>
