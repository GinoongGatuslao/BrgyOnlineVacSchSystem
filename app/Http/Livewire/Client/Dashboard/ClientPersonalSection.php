<?php

namespace App\Http\Livewire\Client\Dashboard;

use App\Models\Appointment;
use App\Models\PatientInformation;
use Livewire\Component;

class ClientPersonalSection extends Component
{
    public function render()
    {

      
        $patient = PatientInformation::where('user_id', '=',auth()->user()->id)->first();
        $user = auth()->user();
        //get all appointments
    $appointments = Appointment::where('patient_id', '=', $patient->id)->where('status','!=','cancelled')->orderBy('id')->get();
        // dd($patient);
        return view('livewire.client.dashboard.client-personal-section', ['patient' => $patient, 'user' => $user, 'appointments' => $appointments]);
    }
}
