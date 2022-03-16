<?php

namespace App\Http\Livewire\Client\Components;

use League\Flysystem\MountManager;
use Livewire\Component;

class Verify extends Component
{
    public $showVerifyButton=true;
    public $patient;
    public function mount($patient){
        $this->patient = $patient;
    }
    public function render()
    {
        return view('livewire.client.components.verify');
    }
}
