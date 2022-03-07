<x-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">
                        {{ __('Welcome to your dashboard!') }}
                    </h3>
                    <p class="max-w-2xl mt-1 text-sm leading-5 text-gray-500">
                        {{ __('Here you can manage your account, view your orders, and edit your address book entries.') }}
                    </p>
                </div>
                <div class="px-4 py-5 bg-gray-50 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <div class="mt-5 sm:mt-0">
                        <h4 class="text-lg font-medium leading-6 text-gray-900">
                            {{ __('Manage your account') }}
                        </h4>
                        <p class="max-w-2xl mt-1 text-sm leading-5 text-gray-500">
                            {{ __('Manage your account settings and set email preferences.') }}
                        </p>
                        <x-jet-action-link href="/user/profile">
                            {{ __('View profile') }}
                        </x-jet-action-link>
                    </div>
                    <div class="mt-5 sm:mt-0">
                        <h4 class="text-lg font-medium leading-6 text-gray-900">
                            {{ __('View your orders') }}
                        </h4>
                        <p class="mt-1 text-sm leading-5 text-gray-500">
                            {{ __('View the status of each of your orders.') }}
</x-layout>
