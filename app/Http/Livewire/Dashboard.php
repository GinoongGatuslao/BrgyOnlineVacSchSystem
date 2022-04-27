<?php

namespace App\Http\Livewire;

use App\Models\Appointment;
use App\Models\AppointmentDate;
use Livewire\Component;

class Dashboard extends Component
{
    public $isSelected;
    public $appDateId;
    public $showScheduleReminder = false;

    

    public function mountVals($dateSelected,$adp_id)
    {
        $this->isSelected = $dateSelected;
        $this->appDateId = $adp_id;
    }

    public function render()
    {

        
        //check if user has appoinment that has been passed
        
        $appointment =[];
        if(auth()->user()->user_type_id == 2){
            $passedDates = AppointmentDate::where('date', '<', date('Y-m-d'))->get('id');
       
            $changeAppointments = Appointment::where('patient_id',auth()->user()->patient_information->id)->where('status','=','unpassed')->whereIn('appointment_date_id',$passedDates)->update(['status' => 'passed']);

            $appointment = Appointment::where('patient_id',auth()->user()->patient_information->id)->where('status','passed')->first();
         
            if($appointment)
            {
                $this->showScheduleReminder = true;
            }
        }
        
        // if request()->route()->parameters are not empty, run mountVals function
        if (!empty(request()->route()->parameters['dateSelected']) && $this->showScheduleReminder == false) {
            $this->mountVals(request()->route()->parameters['dateSelected'],request()->route()->parameters['adp_id']);
        }else{
            $this->mountVals(0,0);
        }
        if(auth()->user()->user_type_id == 2){
            return view('livewire.dashboard',["appointment" => $appointment])->layout('layouts.app');
          }
          else{
            return view('livewire.dashboard')->layout('layouts.app');
          }
      
    }

    public function attendedSchedule($appointment){
        $appointment= Appointment::where('id','=',$appointment)->update(['status' => 'attended']);
        $this->showScheduleReminder = false;
    }
    public function didNotAttendSchedule(){
        $changeAppointments = Appointment::where('patient_id',auth()->user()->patient_information->id)->update(['status' => 'cancelled']);
        redirect()->route('dashboard-home');
    }
}
