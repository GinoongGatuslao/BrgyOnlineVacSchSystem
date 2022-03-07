<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDate extends Model
{
    use HasFactory;

    public function appointment_times()
    {
        return $this->hasMany(AppointmentTime::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
