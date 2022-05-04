<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Vaccine;
use Livewire\Component;

class ManageVaccines extends Component
{

    public $showAddModal = false;
    public $showEditModal = false;
    public $vaccine_name;
    public $dose;
    public $second_dose_sched;
    public $vaccine_id;

    //old values
    public $old_vaccine_name;

    protected $rules = [
        'vaccine_name' => 'required',
        'dose' => 'required|numeric|min:1|max:2',
        'second_dose_sched' => 'required|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.admin.pages.manage-vaccines',[
            'vaccines' => Vaccine::all()->sortBy('vaccine_name')
        ]);
    }

    // public function updated($field)
    // {
    //     $this->validateOnly($field);
    // }

    public function addModal()
    {
        $this->showAddModal = true;
        $this->resetInput();
    }
    public function addVaccine()
    {
        $this->validate();
        Vaccine::create([
            'vaccine_name' => $this->vaccine_name,
            'dose' => $this->dose,
            'second_dose_sched' => $this->second_dose_sched,
        ]);
        $this->showAddModal = false;
        $this->resetInput();
        redirect()->route('manage-vaccines');
    }    

    public function editVaccine($id)
    {
        $this->resetInput();
        $this->showEditModal = true;
        $this->vaccine_id = $id;
        $this->old_vaccine_name = Vaccine::find($id)->vaccine_name;
        $this->vaccine_name = Vaccine::find($id)->vaccine_name;        
        $this->dose = Vaccine::find($id)->dose;
        $this->second_dose_sched = Vaccine::find($id)->second_dose_sched;
    }

    public function updateVaccine()
    {
       

        //if old vaccine name is different from new vaccine name
        if($this->old_vaccine_name != $this->vaccine_name){
            $this->validate([
                'vaccine_name' => 'required|unique:vaccines',
            ]);
            $vaccine = Vaccine::find($this->vaccine_id);
            $vaccine->vaccine_name = $this->vaccine_name;
            $vaccine->dose = $this->dose;
            $vaccine->second_dose_sched = $this->second_dose_sched;
            $vaccine->save();
        }else{
             $this->validate(
                [
                    'vaccine_name' => 'required',
                    'dose' => 'required|numeric|min:1|max:2',
                    'second_dose_sched' => 'required|numeric|min:0',
                ]
             );
            $vaccine = Vaccine::find($this->vaccine_id);
            $vaccine->dose = $this->dose;
            $vaccine->second_dose_sched = $this->second_dose_sched;
            $vaccine->save();
        }
        $this->showEditModal = false;
        $this->resetInput();
        redirect()->route('manage-vaccines');
    }

    public function resetInput()
    {
        $this->vaccine_name = null;
        $this->dose = null;
        $this->second_dose_sched = null;
    }
}
