<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;

class NotificationBadge extends Component
{
    public $showBadge = false;
    public function render()
    {
        //check if there are any notifications from admin_notifications table that are not seen
        $notifications = \App\Models\AdminNotification::where('seen',0)->get()->count();
        if ($notifications > 0) {
            $this->showBadge = true;
        } else {
            $this->showBadge = false;
        }
        return view('livewire.admin.components.notification-badge');
    }
    protected $listeners = ['echo:notification,sendnotifications' => 'rend'];

    public function rend()
    {
       $this->render();
    }
}
