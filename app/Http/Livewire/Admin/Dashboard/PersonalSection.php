<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Appointment;
use App\Models\AppointmentDate;
use App\Models\AppointmentTime;

class PersonalSection extends Component
{
    public $showConfirmModal = false;
    public $showSuccessModal = false;
    public $currentMonth;
    public $currentMonthNumeric;
    public $currentYear;
    public $startDay;
    public $blockSkip = 0;
    public $endDay;
    public function render()
    {

        //if currentmonth is empty, set it to current month
        if (empty($this->currentMonth)) {
            $this->currentMonth = Carbon::now()->format('F');
        }
        //if currentmonthnumeric is empty, set it to current month
        if (empty($this->currentMonthNumeric)) {
            $this->currentMonthNumeric = Carbon::now()->format('m');
        }
        //if currentyear is empty, set it to current year
        if ($this->currentYear == "") {
            $this->currentYear = Carbon::now()->format('Y');
        }
        //if startday is empty, get the first day of the current month as monday etc
        if ($this->startDay == "") {
            $this->startDay = Carbon::now()->startOfMonth()->format('l');
        }

        //if startDay is Sunday, set blockSkip to 0, else if startDay is Monday, set blockSkip to 1, etc
        if ($this->startDay == "Sunday") {
            $this->blockSkip = 0;
        } elseif ($this->startDay == "Monday") {
            $this->blockSkip = 1;
        } elseif ($this->startDay == "Tuesday") {
            $this->blockSkip = 2;
        } elseif ($this->startDay == "Wednesday") {
            $this->blockSkip = 3;
        } elseif ($this->startDay == "Thursday") {
            $this->blockSkip = 4;
        } elseif ($this->startDay == "Friday") {
            $this->blockSkip = 5;
        } elseif ($this->startDay == "Saturday") {
            $this->blockSkip = 6;
        }
        //if endday is empty, get the last day of the currentMonth
        if ($this->endDay == "") {
            $this->endDay = Carbon::create($this->currentYear, $this->currentMonthNumeric)->endOfMonth()->format('d');
        }
        //get the appointments for the current month

        return view('livewire.admin.dashboard.personal-section');
    }
    public $day_to_store=1;
    public function showconfirmModal($day)
    {
        $this->day_to_store=$day;
        $this->showConfirmModal = true;
    }

    public function showsuccessModal()
    {
        $this->showSuccessModal = true;
    }

    public function makeAppointmentSchedule()
    {
        $this->showConfirmModal = false;
        //store date with the day currentMonth and currentYear as Carbon date format with as yyyy-mm-dd
        $date = Carbon::create($this->currentYear, $this->currentMonthNumeric, $this->day_to_store)->format('Y-m-d');
        //store to database the date on appointmentdate table
        $appDate = AppointmentDate::create([
            'date' => $date
        ]);
        $appTime ="";
        $timeStart = 7;
        $timeEnd = 8;
        for ($i = 0; $i <= 8; $i++) {
            //store to database the time on appointmenttime table

            $timeStart++;
            $timeEnd++;

            if($timeStart != 12){
                if($timeEnd == 12){
                    
                $appTime = AppointmentTime::create([
                    'appointment_date_id' => $appDate->id,
                    'time_slot' => $timeStart.':00 AM - '.$timeEnd.':00 PM',
                ]); 
                }else{
                   if($timeStart < 8){
                    $appTime = AppointmentTime::create([
                        'appointment_date_id' => $appDate->id,
                        'time_slot' => $timeStart.':00 PM - '.$timeEnd.':00 PM',
                    ]); 
                   }else{
                    $appTime = AppointmentTime::create([
                        'appointment_date_id' => $appDate->id,
                        'time_slot' => $timeStart.':00 AM - '.$timeEnd.':00 AM',
                    ]); 
                   }
                }
            }else{

                $timeStart = 0;
                $timeEnd = 1;

            }
            
        }
        $this->showsuccessModal();
    }
}
