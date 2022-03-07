<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    @livewire('admin.dashboard.personal-section')
</x-app-layout>
