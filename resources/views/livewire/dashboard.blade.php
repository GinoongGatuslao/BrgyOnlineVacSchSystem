<div>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>
    @if (isset($isSelected))
        @if ($isSelected == '1')
                @if (auth()->user()->user_type_id == 1)
                    @livewire('admin.dashboard.personal-section')
                @else
                {{-- for client --}}
                @endif  
        @else
            @if (auth()->user()->user_type_id == 1)
                @livewire('admin.dashboard.personal-section')
            @else
            {{-- for client --}}
            @endif
        @endif
    
    @else
    ascascasc
    @endif
</div>
