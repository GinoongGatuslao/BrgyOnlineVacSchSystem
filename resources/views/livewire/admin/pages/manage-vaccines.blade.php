<div x-data="{showAddModal : @entangle('showAddModal'), showEditModal : @entangle('showEditModal')}">
    <x-slot name="header">
        {{ __('Manage Vaccines') }}
    </x-slot>
    <div class="container p-10 bg-white drop-shadow-xl rounded-xl">
        <div class="w-auto text-indigo-700 h-screen-80 md:h-screen-30">
   
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Vaccines</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the vaccines registered in the system.</p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                    <button wire:click="addModal" type="button" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add Vaccine</button>
                </div>
                </div>
                <div class="flex flex-col mt-8">
                <div class="-mx-4 -my-2 overflow-x-auto overflow-y-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Name</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"># of Doses</th>
                            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"># of days for 2nd dose</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                <span class="sr-only">Edit</span>
                            </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            <!-- Odd row -->
                            @foreach ($vaccines as $vaccine)

                                @if ($loop->odd)
                                    <tr>
                                        <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">{{ $vaccine->vaccine_name }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $vaccine->dose }}</td>
                                        <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $vaccine->second_dose_sched }}</td>
                                        <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                            <a wire:click="editVaccine({{ $vaccine->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                @else
                                <tr class="bg-gray-50">
                                    <td class="py-4 pl-4 pr-3 text-sm font-medium text-gray-900 whitespace-nowrap sm:pl-6">{{ $vaccine->vaccine_name }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $vaccine->dose }}</td>
                                    <td class="px-3 py-4 text-sm text-gray-500 whitespace-nowrap">{{ $vaccine->second_dose_sched }}</td>
                                    <td class="relative py-4 pl-3 pr-4 text-sm font-medium text-right whitespace-nowrap sm:pr-6">
                                        <a wire:click="editVaccine({{ $vaccine->id }})" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                                @endif

                            @endforeach

                            
                            
                            <!-- More people... -->
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modals --}}
     {{-- add modal --}}
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak x-show="showAddModal">
      
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-cloak x-show="showAddModal" x-transition-enter = "ease-out duration-300"
        x-transition-enter-start = "opacity-0" 
        x-transition-enter-end =  "opacity-100"
        x-transition-leave =  "ease-in duration-200"
        x-transition-leave-start =  "opacity-100"
        x-transition-leave-end = "opacity-0" ></div>
    
        <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div  @click.away="showAddModal = false" x-cloak x-show="showAddModal"
                x-transition-enter =  "ease-out duration-300"
                x-transition-enter-start =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition-enter-end =   "opacity-100 translate-y-0 sm:scale-100"
                x-transition-leave =   "ease-in duration-200"
                x-transition-leave-start =  "opacity-100 translate-y-0 sm:scale-100"
                x-transition-leave-end =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-200 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    
                </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Add new vaccine type</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">You are about to add a new type of vaccine to the system. This action cannot be undone.</p>
                        </div>
                        <div class="mt-2">
                            {{-- form here --}}
                            <form wire:submit.prevent="submit">
                            <p class="font-bold tracking-widest text-md text-slate-700">Vaccine name</p>
                            <input type="text" name="" id="" wire:model="vaccine_name" class="w-full m-1 text-sm rounded-full">
                            @error('vaccine_name')
                                <span class="text-sm text-red-500">{{ $message }}</span>                            
                            @enderror
                            <p class="font-bold tracking-widest text-md text-slate-700">Dose(s)</p>
                            <input type="number" name="" id="" wire:model="dose" class="w-full m-1 text-sm rounded-full">
                            @error('dose')
                                <span class="text-sm text-red-500">{{ $message }}</span>                            
                            @enderror
                            <p class="font-bold tracking-widest text-md text-slate-700">Schedule for second dose.</p>
                            <p class="ml-2 text-sm font-bold tracking-wider text-blue-500"><strong>Note:</strong> if not applicable input <strong>ZERO</strong>(<strong>0</strong>).</p>
                            <input type="number" name="" id="" wire:model="second_dose_sched" class="w-full m-1 text-sm rounded-full">
                            @error('second_dose_sched')
                                <span class="text-sm text-red-500">{{ $message }}</span>                            
                            @enderror
                        

                            
                        </div>
                        
                    </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" wire:click="addVaccine" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-700 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Add New Vaccine Type</button>
                <button type="button" x-on:click="showAddModal = false" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
            </div>
                    </form>
            </div>
        </div>
        </div>
    </div>
    {{-- add modal end --}}
    
    {{-- edit modal start --}}
    <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak x-show="showEditModal">
      
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" x-cloak x-show="showEditModal" x-transition-enter = "ease-out duration-300"
        x-transition-enter-start = "opacity-0" 
        x-transition-enter-end =  "opacity-100"
        x-transition-leave =  "ease-in duration-200"
        x-transition-leave-start =  "opacity-100"
        x-transition-leave-end = "opacity-0" ></div>
    
        <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    
            <div  @click.away="showEditModal = false" x-cloak x-show="showEditModal"
                x-transition-enter =  "ease-out duration-300"
                x-transition-enter-start =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition-enter-end =   "opacity-100 translate-y-0 sm:scale-100"
                x-transition-leave =   "ease-in duration-200"
                x-transition-leave-start =  "opacity-100 translate-y-0 sm:scale-100"
                x-transition-leave-end =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block px-4 pt-5 pb-4 overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-200 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                    </svg>
                    
                </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">Edit vaccine type information</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">Update vaccine type information</p>
                        </div>
                        <div class="mt-2">
                            {{-- form here --}}
                            <form wire:submit.prevent="submit">
                            <p class="font-bold tracking-widest text-md text-slate-700">Vaccine name</p>
                            <input type="text" name="" id="" wire:model="vaccine_name" class="w-full m-1 text-sm rounded-full">
                            @error('vaccine_name')
                                <span class="text-sm text-red-500">{{ $message }}</span>                            
                            @enderror
                            <p class="font-bold tracking-widest text-md text-slate-700">Dose(s)</p>
                            <input type="number" name="" id="" wire:model="dose" class="w-full m-1 text-sm rounded-full">
                            @error('dose')
                                <span class="text-sm text-red-500">{{ $message }}</span>                            
                            @enderror
                            <p class="font-bold tracking-widest text-md text-slate-700">Schedule for second dose.</p>
                            <p class="ml-2 text-sm font-bold tracking-wider text-blue-500"><strong>Note:</strong> if not applicable input <strong>ZERO</strong>(<strong>0</strong>).</p>
                            <input type="number" name="" id="" wire:model="second_dose_sched" class="w-full m-1 text-sm rounded-full">
                            @error('second_dose_sched')
                                <span class="text-sm text-red-500">{{ $message }}</span>                            
                            @enderror
                        

                            
                        </div>
                        
                    </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                <button type="button" wire:click="updateVaccine" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-700 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Update Vaccine Information</button>
                <button type="button" x-on:click="showEditModal = false" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</button>
            </div>
                    </form>
            </div>
        </div>
        </div>
    </div>
    
    {{-- edit modal end --}}
  
    {{-- modals end --}}
</div>
