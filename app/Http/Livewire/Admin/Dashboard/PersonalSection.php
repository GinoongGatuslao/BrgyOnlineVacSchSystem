<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Events\sendnotifications;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Appointment;
use App\Models\AppointmentDate;
use App\Models\AppointmentTime;
use App\Models\Vaccine;

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
    public $daysWithAppointments=[];
    public $appointmentdates;
    public $availableSlots = "-";
    public $occupiedSlots = "-";
    public $totalSlots = "-";
    public $vaccineName = "-";
    public $vaccineid=1;
    public $monthadditive = 0;

    public function render()
    {
       
      
            $this->currentMonth = Carbon::now()->addMonths($this->monthadditive)->format('F');
        
            $this->currentMonthNumeric = Carbon::now()->addMonths($this->monthadditive)->format('m');
        
            $this->currentYear = Carbon::now()->addMonths($this->monthadditive)->format('Y');
        
            $this->startDay = Carbon::now()->addMonths($this->monthadditive)->startOfMonth()->format('l');
        
        $this->appointmentdates = AppointmentDate::where('date','like',$this->currentYear.'-'.$this->currentMonthNumeric.'%')->get();
        $this->daysWithAppointments=[];
        foreach ($this->appointmentdates as $key => $value) {
            $this->daysWithAppointments[] = ['adid' => $value->id,'type' => $value->appointmenttype ,'date' => Carbon::parse($value->date)->format('d'),'available_slots' => $value->available_slots,'max_slots' => $value->max_slots];
            // array_push($this->daysWithAppointments, Carbon::parse($value->date)->format('d'));
        }
        // dd($this->daysWithAppointments);
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

        return view('livewire.admin.dashboard.personal-section')->with('vaccines',Vaccine::all());
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
        
        
        $vaccineInfo = Vaccine::where('id',$this->vaccineid)->first();
        $date1 = $date2 = "";
        //store date with the day currentMonth and currentYear as Carbon date format with as yyyy-mm-dd
        $date1 = Carbon::create($this->currentYear, $this->currentMonthNumeric, $this->day_to_store)->format('Y-m-d');
        if($vaccineInfo->dose > 1){
        $date2 = Carbon::create($this->currentYear, $this->currentMonthNumeric, $this->day_to_store)->addDays($vaccineInfo->second_dose_sched)->format('Y-m-d');
        }
        //store to database the date on appointmentdate table
        $appDate = AppointmentDate::create([
            'date' => $date1,
            'vaccine_id' => $this->vaccineid,
            'appointmenttype'=>'first_dose'
        ]);
        $appDate2=null;
        if($vaccineInfo->dose > 1){
            $appDate2 = new AppointmentDate();
            $appDate2->date = $date2;
            $appDate2->vaccine_id = $this->vaccineid;
            $appDate2->appointmenttype = 'second_dose';
            $appDate2->save();

           // dd($appDate2);
        }
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
        
        if($vaccineInfo->dose > 1){
            $timeStart = 7;
            $timeEnd = 8;
            for ($i = 0; $i <= 8; $i++) {
                //store to database the time on appointmenttime table
    
                $timeStart++;
                $timeEnd++;
    
                if($timeStart != 12){
                    if($timeEnd == 12){
                        
                    $appTime = AppointmentTime::create([
                        'appointment_date_id' => $appDate2->id,
                        'time_slot' => $timeStart.':00 AM - '.$timeEnd.':00 PM',
                    ]); 
                    }else{
                       if($timeStart < 8){
                        $appTime = AppointmentTime::create([
                            'appointment_date_id' => $appDate2->id,
                            'time_slot' => $timeStart.':00 PM - '.$timeEnd.':00 PM',
                        ]); 
                       }else{
                        $appTime = AppointmentTime::create([
                            'appointment_date_id' => $appDate2->id,
                            'time_slot' => $timeStart.':00 AM - '.$timeEnd.':00 AM',
                        ]); 
                       }
                    }
                }else{
    
                    $timeStart = 0;
                    $timeEnd = 1;
    
                }
            }
        }
        
        $this->showConfirmModal = false;
        $this->showSuccessModal = true;
    }

    public function test(){
        event(new sendnotifications(""));
    }    

    public function getSlots($adp_id){
        if ($adp_id != "0") {
            $appointmentdate = AppointmentDate::find($adp_id);
            $this->availableSlots= $appointmentdate->available_slots;
            $this->occupiedSlots= $appointmentdate->max_slots - $appointmentdate->available_slots;
            $this->totalSlots = $appointmentdate->max_slots;
            $this->vaccineName = $appointmentdate->vaccine->vaccine_name;
        }else{
            $this->availableSlots = "-";
            $this->occupiedSlots = "-";
            $this->totalSlots = "-";    
            $this->vaccineName = "-";
        }
    }
    public function redir($adp_id){
        redirect()->route('dashboard',['dateSelected'=> '1','adp_id'=>$adp_id]);
    }

    //make a function to add to additivemonth if parameter is true and subrtract if false
    public function addMonth($add)
    {
        if ($add == 1) {
            $this->monthadditive = $this->monthadditive+1;
        } else {
            $this->monthadditive = $this->monthadditive-1;
        }
        $this->render();
    }
}
