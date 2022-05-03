<div>
    <x-slot name="header">
        {{ __('Ratings') }}
    </x-slot>
    <div class="container p-10 bg-gradient-to-b from-blue-500 via-blue-500 to-transparent rounded-xl">
            <div class="w-auto text-indigo-700 h-screen-80 md:h-screen-30">
                <livewire:livewire-pie-chart :pie-chart-model="$pieChartModel"/>
            </div>
    </div>
</div>
