<?php

namespace App\Http\Livewire\Pages;

use App\Models\PatientInformation;
use App\Models\PersonnelInformation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

    public $photo;
    public $showFileUpload = false;
    public $contact_number;
    public $email;
    public $password;
    public $password_confirmation;
    public $old_email;

    protected $rules = [
        'contact_number' => 'min:6|regex:/^\+?[0-9]{10,13}$/|unique:patient_information',
        'email' => 'email',
        'password' => 'confirmed|min:8',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public  function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:5120', // 5MB Max
        ]); 
    }
    public function save()
    {
        $userUpdate=User::where('id',auth()->user()->id)->update([
            'photo_url' => $this->photo->store('avatars'),
        ]);
        if($userUpdate){
            session()->flash('success','Profile Updated Successfully');
            return redirect( route('edit-profile'));
        }
    }
    public function submit()
    {
       
 
        //if password is not empty
        if(!empty($this->password)){
            $this->validate([
                'password' => 'confirmed|min:8',
            ]);
            if($this->old_email != $this->email){
                $this->validate([
                    'email' => 'email|unique:users',
                ]);
                $user = User::where('id',auth()->user()->id)->update(['password'=> Hash::make($this->password),'email'=>$this->email]);
            }else{
                $user = User::where('id',auth()->user()->id)->update(['password'=> Hash::make($this->password)]);
            }
            
        }else if(!empty($this->email)){
            if($this->old_email != $this->email){
                $this->validate([
                    'email' => 'email|unique:users',
                ]);
                $user = User::where('id',auth()->user()->id)->update(['email'=>$this->email]);
            }
        }
      
        
        $user = auth()->user();
        if($user->user_type_id==1){
            $user = PersonnelInformation::where('user_id',auth()->user()->id)->update([
                'contact_number' => '63'.substr($this->contact_number,'-10'),
            ]);
        }else{
            $user = PatientInformation::where('user_id',auth()->user()->id)->update([
                'contact_number' => '63'.substr($this->contact_number,'-10'),
            ]);
        }
        redirect()->route('dashboard-home');
        
    }

    public function render()
    {
        
        $patient = PatientInformation::where('user_id', '=',auth()->user()->id)->first();
        $user = auth()->user();
        $photo_url = $user->photo_url ?? 'none';
        if($user->user_type_id==1){
            $patient = PersonnelInformation::where('user_id', '=',auth()->user()->id)->first();
            if($this->contact_number ==""){
                $this->contact_number = $patient->contact_number;
            }
            if($this->old_email ==""){
                $this->old_email = $this->email = $user->email;
            }
        }else{
            $patient = PatientInformation::where('user_id', '=',auth()->user()->id)->first();
            if($this->contact_number ==""){
                $this->contact_number = $patient->contact_number;
            }
            if($this->old_email ==""){
                $this->old_email = $this->email = $user->email;
            }
        }
        return view('livewire.pages.edit-profile',['patient' => $patient, 'user' => $user, 'photo_url' => $photo_url]);
    }
}
