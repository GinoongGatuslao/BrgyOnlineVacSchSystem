<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $isSelected;
    public $appDateId;

    

    public function mountVals($dateSelected,$adp_id)
    {
        $this->isSelected = $dateSelected;
        $this->appDateId = $adp_id;
    }

    public function render()
    {
        // if request()->route()->parameters are not empty, run mountVals function
        if (!empty(request()->route()->parameters)) {
            $this->mountVals(request()->route()->parameters['dateSelected'],request()->route()->parameters['adp_id']);
        }else{
            $this->mountVals(0,0);
        }
        return view('livewire.dashboard')->layout('layouts.app');
    }
}
