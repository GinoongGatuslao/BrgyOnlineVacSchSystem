<div x-data="{showScheduleReminder : @entangle('showScheduleReminder')}">
    
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    @if (isset($isSelected))
        @if ($isSelected == '1')
                @if (auth()->user()->user_type_id == 1)
                    @livewire('admin.dashboard.timeslots', ['aDid' => $appDateId])
                @else
                {{-- for client --}}
                
                @endif  
                @livewire('pages.schedule-checker')
        @else
            @if (auth()->user()->user_type_id == 1)
                @livewire('admin.dashboard.personal-section')
            @else
                @livewire('client.dashboard.client-personal-section')
            @endif
        @endif
    
    @else
    <div class="min-h-full px-4 py-16 bg-white rounded-lg sm:px-6 sm:py-24 md:grid md:place-items-center lg:px-8">
        <div class="mx-auto max-w-max">
        <main class="sm:flex">
            <p class="text-4xl font-extrabold text-indigo-600 sm:text-5xl">404</p>
            <div class="sm:ml-6">
            <div class="sm:border-l sm:border-gray-200 sm:pl-6">
                <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">Page not found</h1>
                <p class="mt-1 text-base text-gray-500">Please check the URL in the address bar and try again.</p>
            </div>
            <div class="flex mt-10 space-x-3 sm:border-l sm:border-transparent sm:pl-6">
                <a href="/" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> Go back home </a>
                <a href="/" class="inline-flex items-center px-4 py-2 text-sm font-medium text-indigo-700 bg-indigo-100 border border-transparent rounded-md hover:bg-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"> Contact support </a>
            </div>
            </div>
        </main>
        </div>
    </div>
    @endif
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="fixed inset-0 z-10 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" x-cloak x-show="showScheduleReminder">
        <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0" x-cloak x-show="showScheduleReminder">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" x-transition-enter = "ease-out duration-300"
        x-transition-enter-start =  "opacity-0"
        x-transition-enter-end =   "opacity-100"
        x-transition-leave =  "ease-in duration-200"
        x-transition-leave-start =  "opacity-100"
        x-transition-leave-end =  "opacity-0" x-cloak x-show="showScheduleReminder" ></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="relative inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" x-cloak x-show="showScheduleReminder"
        x-transition-enter =  "ease-out duration-300"
        x-transition-enter-start =  "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition-enter-end =  "opacity-100 translate-y-0 sm:scale-100"
        x-transition-leave =  "ease-in duration-200"
        x-transition-leave-start =  "opacity-100 translate-y-0 sm:scale-100"
        x-transition-leave-end = "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" >
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
                <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-green-100 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                <!-- Heroicon name: outline/exclamation -->
                
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">How was it?</h3>
                <div class="mt-2">
                    @if (isset($appointment))
                    <p class="text-sm text-gray-500">Did you attend your scheduled vaccination last {{ Carbon\Carbon::parse($appointment->appointmentDate->date)->format("F d, Y") }}</p>
                    @endif
                  
                </div>
                </div>
            </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                @if (isset($appointment))
            <button type="button" wire:click.prevent='attendedSchedule({{ $appointment->id }})' class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">Yes I did!</button>
            <button type="button" wire:click.prevent='didNotAttendSchedule' class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">No I did not.</button>
            @endif
            </div>
        </div>
        </div>
    </div>
  
</div>
