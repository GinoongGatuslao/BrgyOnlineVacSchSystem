<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function appointmentType()
    {
        return $this->hasOne(AppointmentType::class);
    }

    public function appointmentDate()
    {
        return $this->hasOne(AppointmentDate::class);
    }

    public function appointmentTime()
    {
        return $this->hasOne(AppointmentTime::class);
    }

    public function patient()
    {
        return $this->hasOne(PatientInformation::class, 'id', 'patient_id');
    }

    public function vaccine()
    {
        return $this->hasOne(Vaccine::class);
    }
}
