<?php

namespace App\Http\Livewire\Client\Dashboard;

use App\Events\sendnotifications;
use App\Models\AdminNotification;
use App\Models\Appointment;
use App\Models\AppointmentDate;
use App\Models\AppointmentTime;
use App\Models\PatientInformation;
use App\Models\Vaccine;
use Carbon\Carbon;
use Livewire\Component;

class ScheduleVaccination extends Component
{

    public $showConfirmModal = false;
    public $showSuccessModal = false;    
    public $selectedId;
    public $apTimeID;
    public $schedshow = 4;
   

    public function render()
    {
        //get patient information of logged in user
        $user = auth()->user();
        $patient = PatientInformation::where('user_id',$user->id)->first();        
        $appointmentTimes = $selectedDate =[];
        $appointments = Appointment::where('patient_id',$patient->id)->where('status',"!=" ,"cancelled")->get()->count();
        if ($this->selectedId != 0) {
            $appointmentTimes = AppointmentTime::where('appointment_date_id',$this->selectedId)->get();
            if ($this->apTimeID == null) {
                $this->apTimeID = $appointmentTimes[0]->id;
            }
            $selectedDate = AppointmentDate::where('id',$this->selectedId)->first();
        }
        //dd($selectedDate);
        $appointmentdates = AppointmentDate::where('available_slots','>',0)->where('date','>=',Carbon::now()->format('Y-m-d'))->where('appointmenttype','like','first_dose')->orderBy('date')->get();
        
        return view('livewire.client.dashboard.schedule-vaccination',[
            'appointmentdates' => $appointmentdates,
            'appointmentTimes' => $appointmentTimes,
            'selectedDate' => $selectedDate,
            'patient' => $patient,
            'appointments' => $appointments,
        ]);
    }

    public function showConfirmModal($id)
    {
        $this->showConfirmModal = true;
        $this->apTimeID = null;
        $this->selectedId = $id;
    }

    public function showSuccessModal()
    {
        $this->showSuccessModal = true;
    }
    
    //increase schedshow by 4
    public function increaseSchedshow()
    {
        $this->schedshow += 4;
        $this->render();
    }

    public function setAppointmentSchedule()
    {
        $this->showConfirmModal = false;
        $patient = PatientInformation::where('user_id',auth()->user()->id)->first();   
        $appointmentdate = AppointmentDate::where('id',$this->selectedId)->first();
        $vaccineInfo = Vaccine::where('id',$appointmentdate->vaccine_id)->first();
       
        $appointmentTimes = AppointmentTime::where('appointment_date_id',$this->selectedId)->where('id',$this->apTimeID)->first();
        // dd(Carbon::parse($appointmentdate->date)->format('F d, Y'));
        if($vaccineInfo->dose > 1){
            $appointmentdate2 = AppointmentDate::where('appointmenttype','second_dose')->where('date',Carbon::parse($appointmentdate->date)->addDays($vaccineInfo->second_dose_sched)->format('Y-m-d'))->first();
            $appointmentTimes2 = AppointmentTime::where('appointment_date_id',$appointmentdate2->id)->where('time_slot',$appointmentTimes->time_slot)->first();
            

            $appointment = new Appointment();
            $appointment->appointment_type_id = 1;
            $appointment->appointment_date_id = $appointmentdate->id;
            $appointment->appointment_time_id = $appointmentTimes->id;
            $appointment->vaccine_id = $vaccineInfo->id;
            $appointment->patient_id = $patient->id;
            $appointment->status ="unpassed";
            $appointment->save();
           
            $appointmentdate->available_slots -= 1;
            $appointmentdate->save();

            $appointmentTimes->available_slots -= 1;
            $appointmentTimes->save();

            $appointment2 = new Appointment();
            $appointment2->appointment_type_id = 2;
            $appointment2->appointment_date_id = $appointmentdate2->id;
            $appointment2->appointment_time_id = $appointmentTimes2->id;
            $appointment2->vaccine_id = $vaccineInfo->id;
            $appointment2->patient_id = $patient->id;     
            $appointment2->status ="unpassed";
            $appointment2->save();

            $appointmentdate2->available_slots -= 1;
            $appointmentdate2->save();

            $appointmentTimes2->available_slots -= 1;
            $appointmentTimes2->save();

            if ($appointmentTimes->available_slots == 0) {
                $an = new AdminNotification;
                $an->message = "Appointment Slot on ".Carbon::parse($appointmentdate->date)->format('F d, Y')." @ ".$appointmentTimes->time_slot." have all been taken. Please check the schedule for more information.";
                $an->user_id = 1;
                $an->appointment_date_id = $appointmentdate->id;
                $an->save();
            }
            if ($appointmentdate->available_slots == 0) {
                $an = new AdminNotification;
                $an->message = "Appointment Slot on ".Carbon::parse($appointmentdate->date)->format('F d, Y').", have all been taken. Please check the schedule for more information.";
                $an->user_id = 1;
                $an->appointment_date_id = $appointmentdate->id;
                $an->save();
            }
            if ($appointmentTimes2->available_slots == 0) {
                $an = new AdminNotification;
                $an->message = "Appointment Slot on ".Carbon::parse($appointmentdate2->date)->format('F d, Y')." @ ".$appointmentTimes2->time_slot." have all been taken. Please check the schedule for more information.";
                $an->user_id = 1;
                $an->appointment_date_id = $appointmentdate2->id;
                $an->save();
            }
            if ($appointmentdate2->available_slots == 0) {
                $an = new AdminNotification;
                $an->message = "Appointment Slot on ".Carbon::parse($appointmentdate2->date)->format('F d, Y').", have all been taken. Please check the schedule for more information.";
                $an->user_id = 1;
                $an->appointment_date_id = $appointmentdate2->id;
                $an->save();
            }
            $an = new AdminNotification;
            $an->message = auth()->user()->name."has scheduled for a vaccination on ".Carbon::parse($appointmentdate->date)->format('F d, Y')." @ ".$appointmentTimes->time_slot.".";
            $an->user_id = 1;
            $an->appointment_date_id = $appointmentdate->id;
            $an->save();
            $an = new AdminNotification;
            $an->message = auth()->user()->name."has scheduled for a vaccination on ".Carbon::parse($appointmentdate2->date)->format('F d, Y')." @ ".$appointmentTimes2->time_slot.".";
            $an->user_id = 1;
            $an->appointment_date_id = $appointmentdate2->id;
            $an->save();            


            event(new sendnotifications($appointmentTimes->id));           
            $this->showSuccessModal();
        }else{
            $appointment = new Appointment();
            $appointment->appointment_type_id = 1;
            $appointment->appointment_date_id = $appointmentdate->id;
            $appointment->appointment_time_id = $appointmentTimes->id;
            $appointment->vaccine_id = $vaccineInfo->id;
            $appointment->patient_id = $patient->id;     
            $appointment->status ="unpassed";
            $appointment->save();

            $appointmentdate->available_slots -= 1;
            $appointmentdate->save();

            $appointmentTimes->available_slots -= 1;
            $appointmentTimes->save();
            
            // if $appDate->available_slots is 0, send event sendnotifications and make new admin notification        
            if ($appointmentTimes->available_slots == 0) {
                $an = new AdminNotification;
                $an->message = "Appointment Slot on ".Carbon::parse($appointmentdate->date)->format('F d, Y')." @ ".$appointmentTimes->time_slot." have all been taken. Please check the schedule for more information.";
                $an->user_id = 1;
                $an->appointment_date_id = $appointmentdate->id;
                $an->save();
                event(new sendnotifications($appointmentTimes->id));
            }
            if ($appointmentdate->available_slots == 0) {
                $an = new AdminNotification;
                $an->message = "Appointment Slot on ".Carbon::parse($appointmentdate->date)->format('F d, Y').", have all been taken. Please check the schedule for more information.";
                $an->user_id = 1;
                $an->appointment_date_id = $appointmentdate->id;
                $an->save();
                event(new sendnotifications($appointmentTimes->id));
            }
            
            $this->showSuccessModal();
           
        }
       
    }
}
