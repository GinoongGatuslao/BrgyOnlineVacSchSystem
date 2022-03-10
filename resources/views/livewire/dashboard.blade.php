<div>
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
        @else
            @if (auth()->user()->user_type_id == 1)
                @livewire('admin.dashboard.personal-section')
            @else
                @livewire('client.dashboard.client-personal-section')
            @endif
        @endif
    
    @else
    ascascasc
    @endif
</div>
