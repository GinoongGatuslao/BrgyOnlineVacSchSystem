<?php

namespace App\Http\Livewire\Pages;

use App\Models\AdminNotification;
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
                $patient_info =PatientInformation::where('id','=',$patient->id)->first();
                $contactNumber = substr($patient_info->contact_number, -10);
                $appointment = Appointment::where('status','=','today')->where('patient_id','=',$patient->id)->first();
                $nexmo = app('Nexmo\Client');    
                $nexmo->message()->send([
                    'to'   => '+63'.$contactNumber,
                    'from' => 'BOVVS',
                    'text' => 'Good Day, '.$patient_info->first_name.'! Your vaccination is scheduled for tomorrow, '.date('F d, Y', strtotime('+1 day')).', at '.$appointment->appointmentTime->time_slot.'. Please be on time. Thank you!'
                ]);
            }
        }
        $patientsToday = $this->getPatientIDSToday();
        if(!empty($patientsToday)){
            foreach($patientsToday as $patient){

                $patient_info =PatientInformation::where('id','=',$patient->id)->first();
                $contactNumber = substr($patient_info->contact_number, -10);
                $appointment = Appointment::where('status','=','today')->where('patient_id','=',$patient_info->id)->first();

                $nexmo = app('Nexmo\Client');    
                $nexmo->message()->send([
                    'to'   => '+63'.$contactNumber,
                    'from' => 'BOVVS',
                    'text' => 'Good Day, '.$patient_info->first_name.'! Your vaccination is scheduled for TODAY, '.date('F d, Y').', at '.$appointment->appointmentTime->time_slot.'. Please be on time. Thank you!'
                ]);
            }
        }
        return view('livewire.pages.schedule-checker');
    }
    public function getPatientIDS(){
        $patients= [];
         //get date for tomorrow
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $appSched = AppointmentDate::where('date','<=',$tomorrow)->first();
        //dd($appSched);
        if(isset($appSched)){
            $appointments = Appointment::where('appointment_date_id','=',$appSched->id)->where('sms_sent','=','no')->get('patient_id');
            $appointmentsUpdate = Appointment::where('appointment_date_id','=',$appSched->id)->where('sms_sent','=','no')->update(['sms_sent' => 'sent']);
            if(isset($appointments)){
                $patients = PatientInformation::whereIn('id',$appointments)->get('id');
            }        
        }
        //if patients isset
        if(!empty($patients)){
           
            foreach($patients as $patient){
               $tomorrow = date('F d, Y', strtotime('+1 day'));
               $appointment = Appointment::where('appointment_date_id','=',$appSched->id)->where('patient_id','=',$patient->id)->first();
               $notif = new AdminNotification;
               $notif->message = 'Your vaccination is scheduled for tomorrow, '.$tomorrow.', at '.$appointment->appointmentTime->time_slot.'. Please be on time. Thank you!';
               $notif->user_id= PatientInformation::where('id',$patient->id)->first()->user_id;
               $notif->appointment_date_id = $appointment->appointment_date_id;
               $notif->save();
             
            }
            return $patients;
        }
        else{
            return [];
        }
    }
    public function getPatientIDSToday(){
        $patients= [];
         //get date for tomorrow
        $tomorrow = date('Y-m-d');
        $appSched = AppointmentDate::where('date','=',$tomorrow)->first();
        // dd($appSched);
        if(isset($appSched)){
            $appointments = Appointment::where('appointment_date_id','=',$appSched->id)->where('sms_sent_for_today','=','no')->get('patient_id');
            $appointmentsUpdate = Appointment::where('appointment_date_id','=',$appSched->id)->where('sms_sent_for_today','=','no')->update(['sms_sent_for_today' => 'sent']);
            if(isset($appointments)){
                $patients = PatientInformation::whereIn('id',$appointments)->get('id');
            }        
        }
        //if patients isset
        if(!empty($patients)){
           
            foreach($patients as $patient){
               $tomorrow = date('F d, Y', strtotime('+1 day'));
               $appointment = Appointment::where('appointment_date_id','=',$appSched->id)->where('patient_id','=',$patient->id)->first();
               $notif = new AdminNotification;
               $notif->message = 'Your vaccination is scheduled for today, '.$tomorrow.', at '.$appointment->appointmentTime->time_slot.'. Please be on time. Thank you!';
               $notif->user_id= PatientInformation::where('id',$patient->id)->first()->user_id;
               $notif->appointment_date_id = $appointment->appointment_date_id;
               $notif->save();
             
            }
            return $patients;
        }
        else{
            return [];
        }
    }

    public function setstatustoday(){
        //get date for tomorrow
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $appSched = AppointmentDate::where('date','=',$tomorrow)->first();
        
        // dd($appSched);
        // $appointments = Appointment::where('appointment_date_id',$appSched->id)->where('status','!=','unpassed')->update(['status' => 'today']);
       if(isset($appSched)){
        $appointments = Appointment::where('appointment_date_id','=',$appSched->id)->update(['status' => 'today']);
       }
        
    }
}
