<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Appointment;
use App\Models\AppointmentDate;
use App\Models\PatientInformation;
use App\Models\Purok;
use App\Models\Vaccine;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class VaccineReports extends Component
{

    //sorters
    public $sortSex = false;
    public $sortPurok = false;
    public $sortAppointmentType = false;
    public $sortAppointmentDate = false;
    public $sortAppointmentTime = false;
    public $sortVaccine = false;
    public $sortName = false;


    public $search_name="";
    public $vaccine_ids = [];
    public $purok_ids;
    public $vaccine_id;
    public $vaccine_counts=[];
    public $date_all = false;
    public $selected_date;

    public function render()
    {
        $orderBySex = $this->sortSex ? 'desc' : 'asc';
        $orderByPurok = $this->sortPurok ? 'desc' : 'asc';
        $orderByAppointmentType = $this->sortAppointmentType ? 'desc' : 'asc';
        $orderByAppointmentDate = $this->sortAppointmentDate ? 'desc' : 'asc';
        $orderByAppointmentTime = $this->sortAppointmentTime ? 'desc' : 'asc';
        $orderByVaccine = $this->sortVaccine ? 'desc' : 'asc';
        $orderByName = $this->sortName ? 'desc' : 'asc';
        
        $dateQuery =[];

        if($this->date_all != false){
            $dateQuery = AppointmentDate::all()->pluck('id')->toArray();
        }else{
            if($this->selected_date != null){
                $dateQuery = AppointmentDate::where('date',Carbon::parse($this->selected_date)->format('Y-m-d'))->get()->pluck('id')->toArray();
            }else{
                $dateQuery = AppointmentDate::all()->pluck('id')->toArray();
            }    
               
        }

        if(isset($this->vaccine_ids) && count($this->vaccine_ids)>0){
            $allFalse = false;
          foreach ($this->vaccine_ids as $vaccine_id){
                if($vaccine_id==0){
                    $allFalse = true;
                }else{
                    $allFalse = false;
                    break;
                }
          }
          if($allFalse){
                $this->vaccine_ids = [];
          }
        }
        if(isset($this->purok_ids) && count($this->purok_ids)>0){
            $allFalse = false;
            foreach ($this->purok_ids as $purok_id){
                    if($purok_id==0){
                        $allFalse = true;
                    }else{
                        $allFalse = false;
                        break;
                    }
                }
                if($allFalse){
                    $this->purok_ids = [];
                }
        }

        $patient_ids=[];
        $vaccines = Vaccine::all();
        $puroks =Purok::all();
        $appointment_lists = Appointment::whereHas('patient',function($q){
            $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
            })
        ->whereHas('appointmentDate',function($q) use($dateQuery){
            $q->whereIn('id',$dateQuery);
        })
        ->join('patient_information','appointments.patient_id','patient_information.id')
        ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->orderBy('patient_information.first_name',$orderByName)->get();
        $count = $appointment_lists->count();


        if($this->purok_ids != null && count($this->purok_ids) > 0){

            $patient_ids = PatientInformation::whereIn('purok_id',$this->purok_ids)->pluck('id')->toArray();
            $appointment_lists = Appointment::whereIn('patient_id', $patient_ids)
            ->whereHas('patient',function($q){
                $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                })
            ->whereHas('appointmentDate',function($q) use($dateQuery){
                $q->whereIn('id',$dateQuery);
            })
            ->join('patient_information','appointments.patient_id','patient_information.id')
            ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->orderBy('patient_information.first_name',$orderByName)->get();
            $count = $appointment_lists->count();


        }

        if($this->vaccine_ids != null && count($this->vaccine_ids) > 0){


            $appointment_lists = Appointment::whereIn('vaccine_id',$this->vaccine_ids)
            ->whereHas('patient',function($q){
                $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                })
            ->whereHas('appointmentDate',function($q) use($dateQuery){
                $q->whereIn('id',$dateQuery);
            })
            ->join('patient_information','appointments.patient_id','patient_information.id')
            ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->orderBy('patient_information.first_name',$orderByName)->get();
            $count = $appointment_lists->count();

            
            if($this->purok_ids != null && count($this->purok_ids) > 0){

                  $patient_ids = PatientInformation::whereIn('purok_id',$this->purok_ids)->pluck('id')->toArray();
                $appointment_lists = Appointment::whereIn('vaccine_id',$this->vaccine_ids)
                ->whereIn('patient_id',$patient_ids)
                ->whereHas('patient',function($q){
                    $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                    })
                ->whereHas('appointmentDate',function($q) use($dateQuery){
                    $q->whereIn('id',$dateQuery);
                })
                ->join('patient_information','appointments.patient_id','patient_information.id')
                ->with('vaccine')->with('appointmentDate')->with('appointmentTime')->with('appointmentType')->orderBy('patient_information.first_name',$orderByName)->get();
                $count = $appointment_lists->count();


            }

          
            // dd($this->vaccine_counts);

        }

        $this->vaccine_counts =[];
        $vaccineToCount =[];
        if(isset($this->vaccine_ids) && count($this->vaccine_ids)>0){
            $vaccineToCount = Vaccine::whereIn('id',$this->vaccine_ids)->get();
            //dd($vaccineToCount);
        }else{
            $vaccineToCount = Vaccine::all();
            //dd($vaccineToCount);
        }
      
        foreach($vaccineToCount as $vaccine_id ){
            $temp2=[];
            $temp = 'vaccine as vaccine_count_for_'.str_replace(" ","_",$vaccine_id->vaccine_name);
            if(isset($patient_ids) && count($patient_ids) > 0){
            $temp2= Appointment::where('vaccine_id',$vaccine_id->id)
            ->whereIn('patient_id',$patient_ids)
            ->whereHas('patient',function($q){
                $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                })
            ->whereHas('appointmentDate',function($q) use($dateQuery){
                $q->whereIn('id',$dateQuery);
            })
            ->count();
            }else{
                $temp2= Appointment::where('vaccine_id',$vaccine_id->id)
            ->whereHas('patient',function($q){
                $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
                })
            ->whereHas('appointmentDate',function($q) use($dateQuery){
                $q->whereIn('id',$dateQuery);
            })
            ->count();
            }
           
            $this->vaccine_counts [] = [$vaccine_id->vaccine_name, $temp2];
        }



        // dd($patient_list);
        // $appointment_list = Appointment::whereIn('vaccine_id',$this->vaccine_ids)->with(['patient'=> function($q){
        //         $q->whereRaw("CONCAT(`first_name`,' ',`middle_name`,' ',`last_name`) LIKE ('".$this->search_name."%')");
        // }])->get();   

        return view('livewire.admin.pages.vaccine-reports',compact('vaccines','appointment_lists','puroks','count'));

        // return view('livewire.admin.pages.vaccine-reports',compact('vaccines'));
    }

    public function updated($name, $value){
              
    }

    public function clearDates(){
        $this->selected_date = null;
        $this->date_all = false;
    }

    
}
