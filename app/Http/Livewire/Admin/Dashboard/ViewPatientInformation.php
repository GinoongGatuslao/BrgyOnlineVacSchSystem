<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Appointment;
use App\Models\PatientInformation;
use Livewire\Component;

class ViewPatientInformation extends Component
{
    //mount
    public $patientID;
    public function mount($patient_id)
    {
        $this->patientID = $patient_id;
        //set as integer
        $this->patientID = (int)$this->patientID;
        
    }
    public function render()
    {
        $patient = PatientInformation::where('id',$this->patientID)->first();
        // dd($patient);
        $user = $patient->user;
        //get all appointments
        $photo_url = $user->photo_url ?? 'none';
        
    $appointments = Appointment::where('patient_id', '=', $patient->id)->where('status',"!=" ,"cancelled")->orderBy('id')->get();
        return view('livewire.admin.dashboard.view-patient-information',['patient'=>$patient,'appointments'=>$appointments,'user'=>$user ,'photo_url'=>$photo_url])->layout('layouts.app');
    }
}
