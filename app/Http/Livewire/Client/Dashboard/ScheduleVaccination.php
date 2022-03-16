<?php

namespace App\Http\Livewire\Client\Dashboard;

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
        $patient = PatientInformation::where('user_id',auth()->user()->id)->first();   
        $appointmentdate = AppointmentDate::where('id',$this->selectedId)->first();
        $appointmentTimes = AppointmentTime::where('appointment_date_id',$this->selectedId)->where('id',$this->apTimeID)->first();
        $vaccineInfo = Vaccine::where('id',$appointmentdate->vaccine_id)->first();
        if($vaccineInfo->doses > 1){
           
        }else{
            $appointment = new Appointment();
            $appointment->appointment_type_id = 1;
            $appointment->appointment_date_id = $appointmentdate->id;
            $appointment->appointment_time_id = $appointmentTimes->id;
            $appointment->vaccine_id = $vaccineInfo->id;
            $appointment->patient_id = $patient->id;     
            $appointment->save();

            $appointmentdate->available_slots -= 1;
            $appointmentdate->save();

            $appointmentTimes->available_slots -= 1;
            $appointmentTimes->save();

            $this->showConfirmModal = false;
            $this->showSuccessModal();
        }
       
    }
}
