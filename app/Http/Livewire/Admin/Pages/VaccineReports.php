<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\PatientInformation;
use Livewire\Component;

class VaccineReports extends Component
{
    public $search_name;

    public function render()
    {
        $patient_list = PatientInformation::where('name')->with('appointment')->get();
        return view('livewire.admin.pages.vaccine-reports');
    }
}
