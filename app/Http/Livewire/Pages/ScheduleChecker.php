<?php

namespace App\Http\Livewire\Pages;

use App\Models\Appointment;
use App\Models\AppointmentDate;
use App\Models\PatientInformation;
use App\Notifications\SendSMSReminder;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class ScheduleChecker extends Component
{
    public function render()
    {
        $this->setstatustoday();
        $patients = $this->getPatientIDS();
        if(!empty($patients)){
            foreach($patients as $patient){
                Notification::send($patient, new SendSMSReminder());
            }
        }
       
        return view('livewire.pages.schedule-checker');
    }
    public function getPatientIDS(){
        $patients= [];
        $appSched = AppointmentDate::where('date','=',date('Y-m-d'))->first();
        $appointments = Appointment::where('appointment_date_id','=',$appSched->id)->where('sms_sent','=','no')->get('patient_id');
        if(count($appointments) > 0){
            $patients = PatientInformation::whereIn('id',$appointments)->get('id');
        }        
        return $patients;
    }
    public function setstatustoday(){
        $appSched = AppointmentDate::where('date','=',date('Y-m-d'))->first();
        
        // dd($appSched);
        // $appointments = Appointment::where('appointment_date_id',$appSched->id)->where('status','!=','unpassed')->update(['status' => 'today']);
        $appointments = Appointment::where('appointment_date_id','=',$appSched->id)->update(['status' => 'today']);
        
    }
}
