<?php

namespace App\Http\Livewire\Client\Components;

use App\Models\PatientInformation;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\MountManager;
use Livewire\Component;

class Verify extends Component
{
    public $showVerifyButton=false;
    public $showSendCode = false;
    public $showVerificationBlock = false;
    public $patient;
    public $countdownsecs = 20;
    public $shouldCountdown = 0;
    public $resendable = false;
    public $code;
    public $code_sent;
    public $showVerificationError = false;

    public function mount($patient){
        $this->patient = $patient;
        if($this->patient->contact_number_verified == 'unverified'){
            $this->showVerifyButton = true;
            $this->showSendCode = false;
            $this->showVerificationBlock = false;
        }
    }
    public function render()
    {
        
        return view('livewire.client.components.verify');
    }

    public function countdown($winddown){
        if($winddown == 1){
            $this->countdownsecs--;
            if($this->countdownsecs == 0){
                $this->countdownsecs = 20;
                $this->shouldCountdown = 0;
                $this->resendable = true;
            }
        }
    }

    public function showsendcode(){
        $this->showVerifyButton = false;
        $this->showSendCode = true;
        
    }

    public function sendCode(){
        $this->code_sent = $this->generate_string($this->permitted_chars, 6);
        $contactNumber = substr($this->patient->contact_number, -10);
        $nexmo = app('Nexmo\Client');
    
            $nexmo->message()->send([
                'to'   => '+63'.$contactNumber,
                'from' => 'BOVSS',
                'text' => 'Your verification code for BOVSS is : '.$this->code_sent.' . DO NOT SHARE YOUR CODE WITH ANYONE.'
            ]);
        $this->showVerificationBlock = true;
        $this->showSendCode = false;
            $this->shouldCountdown = 1;
            $this->resendable = false;
    }
    protected $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
 
    protected function generate_string($input, $strength = 6) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
 
    return $random_string;
    }
    public function resendCode(){
        $contactNumber = substr($this->patient->contact_number, -10);
        $nexmo = app('Nexmo\Client');
    
            $nexmo->message()->send([
                'to'   => '+63'.$contactNumber,
                'from' => 'BOVVS',
                'text' => 'Your verification code is '.$this->code_sent.' for BOVVS. DO NOT SHARE THIS CODE WITH ANYONE.'
            ]);
            $this->shouldCountdown = 1;
            $this->resendable = false;
    }

    public function verifyCode(){
        if(strtoupper($this->code) == strtoupper($this->code_sent)){
            $updatedPatient = PatientInformation::find($this->patient->id);
            $updatedPatient->contact_number_verified = 'verified';
            $updatedPatient->save();
            $this->showVerificationBlock = false;
            $this->showVerifyButton = false;
            $this->showSendCode = false;
            $this->showVerificationError = false;
            redirect()->route('dashboard-home');
        }
        else{
            $this->showVerificationError = true;
        }
    }
}
