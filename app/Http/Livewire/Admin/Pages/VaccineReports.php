<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Appointment;
use App\Models\PatientInformation;
use App\Models\Purok;
use App\Models\Vaccine;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VaccineReports extends Component
{
    public $search_name="";
    public $vaccine_ids;
    public $purok_ids;
    public $vaccine_id;
    public $vaccine_counts=[];

    public function render()
    {
        $vaccines = Vaccine::all();
        $puroks =Purok::all();
        $appointment_lists = Appointment::whereHas('patient',function($q){
            $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
            })
        ->with('patient')
        ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->get();
        $count = $appointment_lists->count();


        if($this->purok_ids != null && count($this->purok_ids) > 0){

            $patient_ids = PatientInformation::whereIn('purok_id',$this->purok_ids)->pluck('id')->toArray();
            $appointment_lists = Appointment::whereIn('patient_id', $patient_ids)
            ->whereHas('patient',function($q){
                $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                })
            ->with(['patient'=> function($q){
                        $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                }])
            ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->get();
            $count = $appointment_lists->count();


        }

        if($this->vaccine_ids != null && count($this->vaccine_ids) > 0){


            $appointment_lists = Appointment::whereIn('vaccine_id',$this->vaccine_ids)
            ->whereHas('patient',function($q){
                $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                })
            ->with(['patient'=> function($q){
                        $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                }])
            ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->get();
            $count = $appointment_lists->count();

            
            if($this->purok_ids != null && count($this->purok_ids) > 0){

                  $patient_ids = PatientInformation::whereIn('purok_id',$this->purok_ids)->pluck('id')->toArray();
                $appointment_lists = Appointment::whereIn('vaccine_id',$this->vaccine_ids)
                ->whereIn('patient_id',$patient_ids)
                ->whereHas('patient',function($q){
                    $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                    })
                ->with(['patient'=> function($q){
                            $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                    }])
                ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->get();
                $count = $appointment_lists->count();


            }

            
        }
        $this->vaccine_counts =[];
        $vaccineToCount = Vaccine::whereIn('id',$this->vaccine_ids)->get();
        foreach($vaccineToCount as $vaccine_id){
            $temp = 'vaccine as vaccine_count_for_'.$vaccine_id;
           $this->vaccine_counts = $appointment_lists->loadCount([$temp => function(Builder $query){
                $query  ->where('vaccine_id',$vaccine_id->id);
            }]);
        }
        dd($this->vaccine_counts);  
        
        // dd($patient_list);
        // $appointment_list = Appointment::whereIn('vaccine_id',$this->vaccine_ids)->with(['patient'=> function($q){
        //         $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
        // }])->get();   

        return view('livewire.admin.pages.vaccine-reports',compact('vaccines','appointment_lists','puroks','count'));

        // return view('livewire.admin.pages.vaccine-reports',compact('vaccines'));
    }

    public function updated($name, $value){
              
    }
}
