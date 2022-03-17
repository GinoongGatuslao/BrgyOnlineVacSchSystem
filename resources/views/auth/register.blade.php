<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-register-logo  class="h-auto text-white fill-current w-72 sm:w-52 md:w-96" />
            </a>
        </x-slot>
        <x-slot name="appName">
            <h2 class="font-extrabold leading-tight tracking-widest text-white uppercase text-md drop-shadow-lg md:text-3xl">
                {{ env('APP_NAME') }}
            </h2>
        </x-slot>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="flex w-full mt-4 space-x-2">
                <div class="w-1/2">
                    <x-label for="first_name" :value="__('First Name')" />

                    <x-input id="first_name" class="block w-full mt-1" type="text" name="first_name" :value="old('first_name')" required
                        autofocus />
                </div>
                <!-- Name -->
                <div class="w-1/2">
                    <x-label for="middle_name" :value="__('Middle Name')" />

                    <x-input id="middle_name" class="block w-full mt-1" type="text" name="middle_name" :value="old('middle_name')"
                        autofocus />
                </div>
            </div>
            <!-- Name -->
            <div class="flex w-full mt-4 space-x-2">
                <div class="w-2/3">
                    
                    <x-label for="last_name" :value="__('Last Name')" />

                    <x-input id="last_name" class="w-full mt-1" type="text" name="last_name" :value="old('last_name')" required
                        autofocus />
                
                </div>
                <div class="w-1/3">
                    
                    <x-label for="suffix" :value="__('Suffix')" />

                    <x-input id="suffix" class="w-full mt-1" type="text" name="suffix" :value="old('suffix')"
                        autofocus />
                
                </div>
            </div>
            <div class="mt-4">
                <div class="flex w-full">
                    <x-label for="purok" :value="__('Select Purok')" class="w-2/6 font-bold text-left md:w-1/6" />
                    <x-label for="purok" :value="__('Baranggay New Carmen, Tacurong City, Sultan Kudarat')" class="w-4/6 text-right truncate md:w-5/6"/>
                 </div>
                 <x-select id="purok" class="w-full mt-1" name="purok" :value="old('purok')" required
                 autofocus>
                     <x-slot name="content">
                         @php
                                $puroks = \App\Models\Purok::all();
                         @endphp
                         @foreach ($puroks as $purok)
                             <option value="{{ $purok->id }}">{{ $purok->name }}</option>
                         @endforeach
                     </x-slot>
                 </x-select>
            </div>
            <div class="flex w-full mt-4 space-x-2">
                <div class="w-2/3">
                    
                    <x-label for="birthdate" :value="__('Birthdate')" />

                    <x-input id="birthdate" class="w-full mt-1" type="date" name="birthdate" :value="old('birthdate')" required
                        autofocus />
                
                </div>
                <div class="w-1/3">
                    
                    <x-label for="sex" :value="__('Sex')" />

                    
                    <x-select id="sex" class="w-full mt-1" name="sex" :value="old('sex')" required
                    autofocus>
                        <x-slot name="content">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </x-slot>
                    </x-select>
                        
                
                </div>
            </div>
            
            
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" autofocus autocomplete="on" />
            </div>
            <div class="mt-4">
                <x-label for="contact_number" :value="__('Contact Number')" />

                <x-input id="contact_number" class="block w-full mt-1" type="text" name="contact_number" :value="old('contact_number')" autofocus autocomplete="on" />
                
                
                
            </div>

            <div class="mt-4">
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block w-full mt-1" type="text" name="username" :value="old('username')"
                    required />
            </div>
            
            <div class="flex w-full mt-4 space-x-2">
                <!-- Password -->
                <div class="w-1/2 mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="off" onpaste="return false;" />
                </div>

                <!-- Confirm Password -->
                <div class="w-1/2 mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required autocomplete="off" onpaste="return false;"/>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
