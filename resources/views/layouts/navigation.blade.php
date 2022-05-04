<nav x-data="{ open: false }" class="bg-blue-600 border-b border-blue-300 border-opacity-25 lg:border-none">
    <!-- Primary Navigation Menu -->
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="relative flex items-center justify-between h-16 lg:border-b lg:border-blue-400 lg:border-opacity-25">
            <div class="flex items-center px-2 lg:px-0">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard-home')}}">
                        <x-application-logo class="block w-8 h-8 text-white fill-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="flex space-x-2 md:space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <div class="flex ml-4 md:space-x-4">
                        <x-nav-link :href="route('dashboard',['adp_id' => 0,'dateSelected' => '0'])" :active="request()->routeIs('dashboard') " class="">
                            <span class="hidden md:flex">{{ __('Dashboard') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-auto text-white md:hidden"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.65721519,18.7714023 L6.65721519,15.70467 C6.65719744,14.9246392 7.29311743,14.2908272 8.08101266,14.2855921 L10.9670886,14.2855921 C11.7587434,14.2855921 12.4005063,14.9209349 12.4005063,15.70467 L12.4005063,15.70467 L12.4005063,18.7809263 C12.4003226,19.4432001 12.9342557,19.984478 13.603038,20 L15.5270886,20 C17.4451246,20 19,18.4606794 19,16.5618312 L19,16.5618312 L19,7.8378351 C18.9897577,7.09082692 18.6354747,6.38934919 18.0379747,5.93303245 L11.4577215,0.685301154 C10.3049347,-0.228433718 8.66620456,-0.228433718 7.51341772,0.685301154 L0.962025316,5.94255646 C0.362258604,6.39702249 0.00738668938,7.09966612 0,7.84735911 L0,16.5618312 C0,18.4606794 1.55487539,20 3.47291139,20 L5.39696203,20 C6.08235439,20 6.63797468,19.4499381 6.63797468,18.7714023 L6.63797468,18.7714023" transform="translate(2.5 2)"/></svg>
                        </x-nav-link>
                        
                        @if (auth()->user()->user_type_id == 2)
                        <x-nav-link :href="route('schedule-vaccination')" :active="request()->routeIs('schedule-vaccination') " class="">
                            <span class="hidden md:flex">{{ __('Schedule Vaccination') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="w-6 h-auto text-white fill-current md:hidden"><path d="M6,24H17v2H6a3,3,0,0,1-3-3V7A3,3,0,0,1,6,4H8V2h2V7H8V6H6A1,1,0,0,0,5,7V8H23V7a1,1,0,0,0-1-1H21V4h1a3,3,0,0,1,3,3V18H23V10H5V23A1,1,0,0,0,6,24ZM18,7h2V2H18V4H11V6h7Zm7,17V20H23v4H19v2h4v4h2V26h4V24Z" data-name="31  Calendar,add, Essential, Schedule,add"/></svg>
                        </x-nav-link>
                        @endif
                        @if (auth()->user()->user_type_id == 1)
                        <x-nav-link :href="route('ratings')" :active="request()->routeIs('ratings') " class="">
                            <span class="hidden md:flex">{{ __('Ratings') }}</span>                            
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-auto text-white fill-current md:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                              </svg>
                        </x-nav-link>
                        <x-nav-link :href="route('manage-vaccines')" :active="request()->routeIs('manage-vaccines') " class="">
                            <span class="hidden md:flex">{{ __('Manage Vaccines') }}</span>                            
                        
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-auto text-white fill-current md:hidden"  enable-background="new 0 0 1080 1080" viewBox="0 0 1080 1080"><path d="M180.2,650.1c-14.8,17.8-23,40.4-23,63.6v186.7c0,21.9,17.8,39.7,39.7,39.7h146.4c21.9,0,39.7-17.8,39.7-39.7V713.6   c0-23.2-8.2-45.7-23-63.6c-11.1-13.3-17.2-30.2-17.2-47.5v-11.8c8.7-3,15-11.1,15-20.8v-65.7c0-12.2-9.9-22.1-22.1-22.1H204.5   c-12.2,0-22.1,9.9-22.1,22.1v65.7c0,9.7,6.3,17.9,15.1,20.8v11.8C197.5,619.9,191.4,636.8,180.2,650.1z M358,713.6v186.7   c0,8.1-6.6,14.7-14.7,14.7H196.9c-8.1,0-14.7-6.6-14.7-14.7V713.7c0-17.3,6.1-34.2,17.2-47.6c14.8-17.8,23-40.4,23-63.6V592h95.3   v10.6c0,23.2,8.2,45.7,23,63.6C351.9,679.4,358,696.3,358,713.6z M207.4,507.1h125.4V567h-2.5c0,0,0,0,0,0H210c0,0,0,0,0,0h-2.5   V507.1z"/><path d="M318.3 718.2h-96.4c-6.9 0-12.5 5.6-12.5 12.5s5.6 12.5 12.5 12.5h96.4c6.9 0 12.5-5.6 12.5-12.5S325.2 718.2 318.3 718.2zM318.3 782.7h-96.4c-6.9 0-12.5 5.6-12.5 12.5s5.6 12.5 12.5 12.5h96.4c6.9 0 12.5-5.6 12.5-12.5S325.2 782.7 318.3 782.7zM318.3 847.2h-96.4c-6.9 0-12.5 5.6-12.5 12.5s5.6 12.5 12.5 12.5h96.4c6.9 0 12.5-5.6 12.5-12.5S325.2 847.2 318.3 847.2zM720 650.1c-14.8 17.8-23 40.4-23 63.6v186.7c0 21.9 17.8 39.7 39.7 39.7h146.4c21.9 0 39.7-17.8 39.7-39.7V713.6c0-23.2-8.2-45.7-23-63.6-11.1-13.3-17.2-30.2-17.2-47.5v-11.8c8.7-2.9 15.1-11.1 15.1-20.8v-65.7c0-12.2-9.9-22.1-22.1-22.1H744.2c-12.2 0-22.1 9.9-22.1 22.1v65.7c0 9.7 6.3 17.9 15.1 20.8v11.8C737.2 619.9 731.1 636.8 720 650.1zM897.8 713.6v186.7c0 8.1-6.6 14.7-14.7 14.7H736.7c-8.1 0-14.7-6.6-14.7-14.7V713.7c0-17.3 6.1-34.2 17.2-47.6 14.8-17.8 23-40.4 23-63.6V592h95.3v10.6c0 23.2 8.2 45.7 23 63.6C891.7 679.4 897.8 696.3 897.8 713.6zM747.2 507.1h125.4V567h-2.5c0 0 0 0 0 0H749.7c0 0 0 0 0 0h-2.5V507.1z"/><path d="M858.1 718.2h-96.4c-6.9 0-12.5 5.6-12.5 12.5s5.6 12.5 12.5 12.5h96.4c6.9 0 12.5-5.6 12.5-12.5S865 718.2 858.1 718.2zM858.1 782.7h-96.4c-6.9 0-12.5 5.6-12.5 12.5s5.6 12.5 12.5 12.5h96.4c6.9 0 12.5-5.6 12.5-12.5S865 782.7 858.1 782.7zM858.1 847.2h-96.4c-6.9 0-12.5 5.6-12.5 12.5s5.6 12.5 12.5 12.5h96.4c6.9 0 12.5-5.6 12.5-12.5S865 847.2 858.1 847.2zM451 307.4c-11.1 0-21.6 4.3-29.7 12.3-7.8 8-12.1 18.5-12.1 29.5 0 23.1 18.8 41.8 41.8 41.8h8.4v297.5c0 15.8 10.1 29.2 24.2 34.3v24.6c0 23.5 19.1 42.7 42.7 42.7h1.3v137.3c0 6.9 5.6 12.5 12.5 12.5s12.5-5.6 12.5-12.5V790.2h1.3c23.5 0 42.7-19.1 42.7-42.7v-24.6c14.1-5.1 24.2-18.5 24.2-34.3V391h8.2c11.1 0 21.9-4.4 29.6-12.2 7.9-7.9 12.3-18.5 12.3-29.6 0-23.1-18.8-41.8-41.9-41.8h-44.2v-83.8h9.1c11.1 0 21.9-4.4 29.6-12.2 7.9-7.9 12.3-18.5 12.3-29.6 0-23.1-18.8-41.8-41.9-41.8H486c-11.1 0-21.6 4.3-29.7 12.3-7.8 8-12.1 18.5-12.1 29.5 0 23.1 18.8 41.8 41.8 41.8h9.2v83.8H451zM571.5 747.5c0 9.7-7.9 17.7-17.7 17.7h-27.7c-9.7 0-17.7-7.9-17.7-17.7v-22.3h63V747.5zM595.7 688.6c0 6.4-5.2 11.7-11.7 11.7h-88c-6.4 0-11.7-5.2-11.7-11.7V391h111.3V688.6zM645.8 349.2c0 5.8-2.7 9.7-5 12-3.1 3.1-7.5 4.9-12 4.9h-20.7H471.8 451c-9.3 0-16.8-7.5-16.8-16.8 0-5.8 2.7-9.7 4.8-11.9 2.3-2.3 6.3-5 12-5h56.8 64.5 56.7C638.2 332.4 645.8 339.9 645.8 349.2zM469.2 181.8c0-5.8 2.7-9.7 4.8-11.9 2.3-2.3 6.3-5 12.1-5h107.8c9.3 0 16.9 7.5 16.9 16.8 0 5.8-2.7 9.7-5 12-3.1 3.1-7.5 4.9-12 4.9h-21.6-64.5H486C476.8 198.6 469.2 191.1 469.2 181.8zM520.3 223.6h39.5v83.8h-39.5V223.6z"/><path d="M513.8 439.8h36.5c6.9 0 12.5-5.6 12.5-12.5s-5.6-12.5-12.5-12.5h-36.5c-6.9 0-12.5 5.6-12.5 12.5S506.9 439.8 513.8 439.8zM513.8 495.5H540c6.9 0 12.5-5.6 12.5-12.5s-5.6-12.5-12.5-12.5h-26.2c-6.9 0-12.5 5.6-12.5 12.5S506.9 495.5 513.8 495.5zM513.8 551.1h36.5c6.9 0 12.5-5.6 12.5-12.5s-5.6-12.5-12.5-12.5h-36.5c-6.9 0-12.5 5.6-12.5 12.5S506.9 551.1 513.8 551.1zM513.8 606.8H540c6.9 0 12.5-5.6 12.5-12.5s-5.6-12.5-12.5-12.5h-26.2c-6.9 0-12.5 5.6-12.5 12.5S506.9 606.8 513.8 606.8zM513.8 662.5h36.5c6.9 0 12.5-5.6 12.5-12.5s-5.6-12.5-12.5-12.5h-36.5c-6.9 0-12.5 5.6-12.5 12.5S506.9 662.5 513.8 662.5z"/></svg>
                        </x-nav-link>
                        <x-nav-link :href="route('vaccine-reports')" :active="request()->routeIs('vaccine-reports') " class="">
                            <span class="hidden md:flex">{{ __('Vaccination Reports') }}</span>
                        </x-nav-link>
                        @endif
                        
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="block lg:block lg:ml-4">
                <div class="flex items-center space-x-3">
                    <x-dropdown align="right" width="screen-80" class="mr-3">
                        <x-slot name="trigger">
                            <button type="button"
                                class="flex p-1 text-center text-blue-200 bg-blue-600 rounded-full hover:text-white focus:text-cyan-400">
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: outline/bell -->
                                <div class="flex mx-auto">
                                    <svg class="w-6 h-6 md:w-8" xmlns="http://www.w3.org/2000/svg" fill="none" visewBox="0 0 24 24"
                                        stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <div class="relative top-0 z-50 flex right-5">
                                    @livewire('admin.components.notification-badge')
                                    </div>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content" class="">
                            <div class="px-3 py-2 bg-white">
                                @livewire('components.notifications-dropdown')
                            </div>
                        </x-slot>
                    </x-dropdown>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-white transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                <div>
                                    <span class="flex md:hidden">
                                        
                                        @if (Auth::user()->user_type_id == 1)
                                            {{ Auth::user()->personnel_information->first_name }}
                                        @else
                                            {{ Auth::user()->patient_information->first_name }}
                                        @endif
                                    </span>
                                    <span class="hidden md:flex">{{ Auth::user()->name }}</span>
                                </div>

                                <div class="ml-1">
                                    <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            {{-- <x-dropdown-link href="{{ route('profile.show', Auth::user()) }}"> --}}
                            <x-dropdown-link href="{{ route('edit-profile') }}">
                                {{ __('Your Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Sign Out') }}
                                </x-dropdown-link>
                            </form>


                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>
</nav>
