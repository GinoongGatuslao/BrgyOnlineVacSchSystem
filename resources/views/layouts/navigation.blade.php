<nav x-data="{ open: false }" class="bg-indigo-600 border-b border-indigo-300 border-opacity-25 lg:border-none">
    <!-- Primary Navigation Menu -->
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="relative flex items-center justify-between h-16 lg:border-b lg:border-indigo-400 lg:border-opacity-25">
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
                        
                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="block lg:block lg:ml-4">
                <div class="flex items-center space-x-3">
                    <x-dropdown align="right" width="flex" class="mr-3">
                        <x-slot name="trigger">
                            <button type="button"
                                class="flex-shrink-0 p-1 text-indigo-200 bg-indigo-600 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-600 focus:ring-white">
                                <span class="sr-only">View notifications</span>
                                <!-- Heroicon name: outline/bell -->
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link>
                               <p class="truncate "> {{ __('Log Out char') }}</p>
                            </x-dropdown-link>
                            <x-dropdown-link>
                               <p class="truncate "> {{ __('Lorem Ipsum laba nga text') }}</p>
                            </x-dropdown-link>
                            <x-dropdown-link>
                               <p class="truncate "> {{ __('More Laba text') }}</p>
                            </x-dropdown-link>
                            <x-dropdown-link class="">
                               <p class="truncate "> {{ __('ascasdcksjdhfgksadfkjasgdhfkjashgdfs') }}</p>
                            </x-dropdown-link>
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
                            <x-dropdown-link href="/dashboard">
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
