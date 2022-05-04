<div class="container py-10 rounded-lg shadow-lg bg-gradient-to-b from-white to-gray-100 shadow-slate-400/40 " x-data="{showFileUpload : @entangle('showFileUpload')}">
    
    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"  x-cloak x-show="showFileUpload">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" x-transition-enter =  "ease-out duration-300"
        x-transition-enter-start =  "opacity-0"
        x-transition-enter-end =  "opacity-100"
        x-transition-leave =  "ease-in duration-200"
        x-transition-leave-start =   "opacity-100"
        x-transition-leave-end =  "opacity-0" x-cloak x-show="showFileUpload"></div>
    
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
        <div @click.away="showFileUpload = false" class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-sm sm:w-full sm:p-6"  x-cloak x-show="showFileUpload"
        x-transition-enter = "ease-out duration-300"
        x-transition-enter-start =   "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition-enter-end =  "opacity-100 translate-y-0 sm:scale-100"
        x-transition-leave =  "ease-in duration-200" 
        x-transition-leave-start =   "opacity-100 translate-y-0 sm:scale-100"
        x-transition-leave-end = "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" >
        <form wire:submit.prevent="save" class="">    
            <div class="items-start inline space-y-2">
                
                    @if ($photo)
                       <span class="text-sm italic font-bold"> Photo Preview:</span>
                        <img src="{{ $photo->temporaryUrl() }}" class="inline-block w-24 h-24 ml-5 rounded-full">
                    @endif
                 
                    <input type="file" wire:model="photo" class="font-bold text-indigo-700">
                 
                    @error('photo') <span class="error">{{ $message }}</span> @enderror
                 
                    
                
            </div>
            <div class="mt-5 space-y-2 sm:mt-6">
                <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Save Photo</button>
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-black border border-transparent rounded-md shadow-sm bg-slate-300 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm" x-on:click="showFileUpload=false">Cancel</button>
            </div>
        </form>
        </div>
        </div>
    </div>
  
    <x-slot name="header">
        {{ __('Manage Profile') }}
    </x-slot>
    <div
        class="max-w-3xl px-4 mx-auto sm:px-6 md:flex md:items-center md:justify-between md:space-x-5 lg:max-w-7xl lg:px-8">
        <div class="flex items-center space-x-5">
            <div class="relative flex-shrink-0 group">
                <div class="relative rounded-full group">
                   @if ($photo_url != 'none')
                       <img src="{{asset('storage/'.$photo_url) }}" alt="as" class="w-16 h-16 rounded-full">
                   @else
                    @if ($patient->sex == 'Male')
                    <x-male-avatar width="400" class="w-16 h-auto text-black fill-current group-hover:opacity-5" />
                    @else
                    <x-female-avatar width="400" class="w-16 h-auto text-black fill-current group-hover:opacity-5" />
                    @endif
                   @endif
                    <div class="absolute inset-0 text-center rounded-full shadow-inner" aria-hidden="true">
                       
                    </div>
                    <div class="absolute inset-0 z-50 items-center hidden text-center bg-gray-700 rounded-full bg-opacity-40 group-hover:flex" x-on:click="showFileUpload = true">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 m-auto text-center text-white opacity-0 group-hover:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
                    <form class="relative" wire:submit.prevent="submit">
                        <div class="px-4 py-5 border-t border-gray-200 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Vaccination Status</dt>
                                    <dd class="mt-1 text-sm text-gray-900">Unvaccinated</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Email address</dt>
                                    <dd class="mt-1 text-sm text-gray-900"> 
                                        <input type="email" class="h-10 text-sm text-left text-blue-600 rounded-full w-sm" wire:model="email">
                                        @error('email') <span class="block mt-1 ml-2 text-red-500 error">{{ $message }}</span> @enderror
                                    </dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-500">Mobile Phone</dt>
                                    <dd class="flex items-start mt-1 text-sm text-gray-900">
                                    @if ($patient->contact_number_verified == 'verified')
                                         <span class="italic tracking-wider"> (+63){{ substr($patient->contact_number,-10) }}</span>
                                    @endif
                                        <span class="flex my-auto ml-1 text-xs italic tracking-widest text-gray-400">
                                            @if ($patient->contact_number_verified == 'verified')
                                            <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-auto text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                            <span class="my-auto italic font-bold text-blue-500">Verified</span>
                                            </div>
                                            @else
                                            <div class="block">
                                            <input type="text" class="h-10 text-sm text-left text-blue-600 rounded-full w-sm " wire:model="contact_number" placeholder="639657258615" x-mask="639999999999">
                                            <span class="pl-3 my-auto">Unverified</span>
                                            @error('contact_number') <br> <p class="mt-1 ml-2 text-red-500 error">{{ $message }}</p> @enderror    
                                            </div>                                                                              
                                            @endif
                                        </span>
                                    </dd>
                                       
                                    
                                </div>
                                <div class="sm:col-span-1" x-data="{showPass: true}">
                                    <dt class="flex text-sm font-medium text-gray-500">
                                        <span class="my-auto">Change Password</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" x-on:click="showPass = !showPass" class="w-4 h-4 my-auto ml-1 text-gray-600 hover:text-blue-500"  x-show="showPass == false" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" x-on:click="showPass = !showPass" class="w-4 h-4 my-auto ml-1 text-gray-600 hover:text-blue-500" x-show="showPass == true" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                          </svg>
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900"> 
                                        <span class="block">New Password</span>
                                        <input :type="showPass ? 'password' : 'text'"  class="h-10 text-sm text-left text-blue-600 rounded-full w-screen-30" wire:model="password">
                                        @error('password') <span class="block mt-1 ml-2 text-red-500 error">{{ $message }}</span> @enderror
                                    </dd>
                                    <dd class="mt-1 text-sm text-gray-900">
                                        <span class="block">Confirm New Password</span>
                                        <input :type="showPass ? 'password' : 'text'"  class="h-10 text-sm text-left text-blue-600 rounded-full w-screen-30" wire:model="password_confirmation">
                                        @error('password_confirmation') <span class="block mt-1 ml-2 text-red-500 error">{{ $message }}</span> @enderror
                                    </dd>
                                </div>
                                
                            </dl>
                        </div>
                        <div class="grid grid-cols-2 mx-3 -mb-5 sm:grid-cols-6 w-sm">
                                    
                            <button type="submit" class="col-span-1 col-start-2 p-2 m-1 text-white bg-blue-500 rounded-full text-md lg:col-span-2 lg:col-start-5">Save Changes</button>
                        
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>
</div>
