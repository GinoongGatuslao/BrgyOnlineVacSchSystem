<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Feedback;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Livewire\Component;

class Ratings extends Component
{
    
    public function render()
    {
        $pieChartModel = (new PieChartModel())->setTitle('Ratings')->withDataLabels()->withLegend()->setAnimated(true)->settype("donut")->addSlice('Very Bad',Feedback::where('rating', '1')->count(), '#ff0000')->addSlice('Bad',Feedback::where('rating', '2')->count(), '#ffa500')->addSlice('Average',Feedback::where('rating', '3')->count(), '#c9be00')->addSlice('Good',Feedback::where('rating', '4')->count(), '#00ff00')->addSlice('Very Good',Feedback::where('rating', '5')->count(), '#00ffff');
        return view('livewire.admin.pages.ratings',['pieChartModel' => $pieChartModel]);
    }
}
