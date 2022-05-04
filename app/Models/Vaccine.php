<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;

    protected $fillable = [
        'vaccine_name',
        'dose',
        'second_dose_sched',
    ];

    public function appointmentDates()
    {
        return $this->belongsTo(AppointmentDate::class);
    }

    public function appointments()
    {
        return $this->belongsTo(Appointment::class);
    }
}
