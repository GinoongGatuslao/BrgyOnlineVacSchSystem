<?php

namespace App\Http\Livewire\Client\Dashboard;

use App\Models\PatientInformation;
use Livewire\Component;

class ClientPersonalSection extends Component
{
    public function render()
    {

      
        $patient = PatientInformation::where('user_id', '=',auth()->user()->id)->first();
        
        // dd($patient);
        return view('livewire.client.dashboard.client-personal-section', ['patient' => $patient]);
    }
}
