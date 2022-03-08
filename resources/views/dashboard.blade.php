<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    @if (auth()->user()->user_type_id == 1)
    @livewire('admin.dashboard.personal-section')
    @else

    @endif

</x-app-layout>
