<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Appointment;
use App\Models\AppointmentDate;
use App\Models\AppointmentTime;
use App\Models\PatientInformation;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Timeslots extends Component
{
    public $aDid;   
    public $dateToday;   
    public $tsID;
    public $available_slots= "-";
    public $total_slots = "-";
    public $occupied_slots = "-";
    public $searchterm = "";
    public $searchtermModal = "";
    public function render()
    {
        
        //convert $aDid to integer
        $this->aDid = intval($this->aDid);
        $temp = AppointmentDate::findOrFail($this->aDid)->get('date');
        $this->dateToday=Carbon::parse($temp[0]->date)->format('F d, Y');
        //if tsID is not set, then set it to the first id from AppointmentTime table where appointment_id = aDid
        if(!isset($this->tsID)){
            $this->tsID = AppointmentTime::where('appointment_date_id', $this->aDid)->first()->id;
        }
        $pIDs=[];
        $appointments=[];
        if($this->searchterm != ""){
            $pa= PatientInformation::orWhere('first_name','like',"%".$this->searchterm."%")->orWhere('middle_name','like',"%".$this->searchterm."%")->orWhere('last_name','like',"%".$this->searchterm."%")->get('id');
            foreach ($pa as $key => $value) {
                $pIDs[] = $value->id;
            }
            array_values($pIDs);
            $appointments = Appointment::where('appointment_date_id',$this->aDid)->where('appointment_time_id',$this->tsID)->whereIn('patient_id',$pIDs)->get();
        }else{
            $appointments = Appointment::where('appointment_date_id',$this->aDid)->where('appointment_time_id',$this->tsID)->get();
        }
        $pIDsModal=[];
        $appointmentsModal=[];
        if($this->searchtermModal != ""){
            $pa= PatientInformation::orWhere('first_name','like',"%".$this->searchtermModal."%")->orWhere('middle_name','like',"%".$this->searchtermModal."%")->orWhere('last_name','like',"%".$this->searchtermModal."%")->get('id');
            foreach ($pa as $key => $value) {
                $pIDsModal[] = $value->id;
            }
            array_values($pIDsModal);
            DB::statement("SET SQL_MODE=''");
            $appointmentsModal = Appointment::groupBy('patient_id')->whereIn('patient_id',$pIDsModal)->get();
        }else{
            $appointmentsModal = [];
        }
        
       
        return view('livewire.admin.dashboard.timeslots',['vaccine_name'=>AppointmentDate::find($this->aDid)->vaccine->vaccine_name,'tslots'=>AppointmentTime::where('appointment_date_id',$this->aDid)->get(),
        'appointments'=>$appointments, 'appointmentsModal'=>$appointmentsModal,]);
    }

    public function getAppointments($id)
    {
        $this->tsID = $id;
        $at = AppointmentTime::findOrFail($id);
        $this->available_slots = $at->available_slots;
        $this->total_slots = $at->max_slots;
        $this->occupied_slots = $at->max_slots - $at->available_slots;
    }
}
