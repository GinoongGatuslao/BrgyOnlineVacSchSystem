<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Livewire\Component;

class PersonalSection extends Component
{
    public $currentMonth = "";
    public $currentYear = "";
    public function render()
    {
        //if currentmonth is empty, set it to current month
        if ($this->currentMonth == "") {
            $this->currentMonth = Carbon::now()->format('F');
        }
        //if currentyear is empty, set it to current year
        if ($this->currentYear == "") {
            $this->currentYear = Carbon::now()->format('Y');
        }
        return view('livewire.admin.dashboard.personal-section');
    }
}
