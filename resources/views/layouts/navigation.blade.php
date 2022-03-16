<nav x-data="{ open: false }" class="bg-indigo-600 border-b border-indigo-300 border-opacity-25 lg:border-none">
    <!-- Primary Navigation Menu -->
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div
            class="relative flex items-center justify-between h-16 lg:border-b lg:border-indigo-400 lg:border-opacity-25">
            <div class="flex items-center px-2 lg:px-0">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="{{ route('dashboard',['adp_id' => 0,'dateSelected' => '0']) }}">
                        <x-application-logo class="block w-8 h-8 text-white fill-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <div class="flex space-x-4">
                        <x-nav-link :href="route('dashboard',['adp_id' => 0,'dateSelected' => '0'])" :active="request()->routeIs('dashboard') ">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        @if (auth()->user()->user_type_id == 2)
                        <x-nav-link :href="route('schedule-vaccination')" :active="request()->routeIs('schedule-vaccination') ">
                            {{ __('Schedule Vaccination') }}
                        </x-nav-link>
                        @endif

                    </div>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden lg:block lg:ml-4">
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
                                {{ __('Log Out char') }}
                            </x-dropdown-link>
                            <x-dropdown-link>
                                {{ __('Lorem Ipsum laba nga text') }}
                            </x-dropdown-link>
                            <x-dropdown-link>
                                {{ __('More Laba text') }}
                            </x-dropdown-link>
                            <x-dropdown-link>
                                {{ __('ascasdcksjdhfgksadfkjasgdhfkjashgdfs') }}
                            </x-dropdown-link>
                        </x-slot>
                    </x-dropdown>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-white transition duration-150 ease-in-out hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300">
                                <div>{{ Auth::user()->name }}</div>

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
