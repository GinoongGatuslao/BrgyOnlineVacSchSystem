<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use App\Events\sendnotifications;
use App\Models\AdminNotification;
use App\Models\AppointmentTime;
use App\Models\PatientInformation;
use App\Models\User;

class NotificationsDropdown extends Component
{
    public $notifications=[];

    public function render()
    {
        
        return view('livewire.components.notifications-dropdown');
    }
    public $message="";
    protected $listeners = ['echo:notification,sendnotifications' => 'holy','lols'=>'populateNotifications'];
    // public function getListeners()
    // {
    //     return [
    //         "echo-private:notification.".auth()->user()->id.",sendnotifications" => 'holy',
    //     ];
    // }

    public function populateNotifications()
    {
        $this->notifications = AdminNotification::where('user_id', auth()->user()->id)->orderBy('id','desc')->get();            
    }

    public function markSeen($notifID)
    {
        $notif = AdminNotification::find($notifID);
        $notif->seen = 1;
        $notif->save();        
    }

    public function markAllSeen()
    {
        $notifs = AdminNotification::where('user_id', auth()->user()->id)->get();
        foreach ($notifs as $key => $value) {
            $value->seen = 1;
            $value->save();
        }
    }
}
