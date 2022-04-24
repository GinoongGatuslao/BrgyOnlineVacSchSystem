<?php

namespace App\Http\Livewire\Pages;

use App\Models\PatientInformation;
use App\Models\PersonnelInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

    public $photo;

    public  function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5120', // 5MB Max
        ]); 
    }
    public function save()
    {
       
        $this->photo->store('photos');
    }

    public function render()
    {
        
        $patient = PatientInformation::where('user_id', '=',auth()->user()->id)->first();
        $user = auth()->user();
        if($user->user_type_id==1){
            $patient = PersonnelInformation::where('user_id', '=',auth()->user()->id)->first();
        }
        return view('livewire.pages.edit-profile',['patient' => $patient, 'user' => $user,]);
    }
}
