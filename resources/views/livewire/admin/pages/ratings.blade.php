<div>
    <x-slot name="header">
        {{ __('Ratings') }}
    </x-slot>

    <div class="container bg-gradient-to-b from-blue-500 via-blue-500 to-transparent rounded-xl p-10">
       
            <div class="h-screen-80 md:h-screen-30 w-auto text-indigo-700">
                <livewire:livewire-pie-chart :pie-chart-model="$pieChartModel"/>
            </div>
       
            
    </div>
</div>
