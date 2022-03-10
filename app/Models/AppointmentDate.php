<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'available_slots',
        'max_slots',
        'vaccine_id',
    ];

    public function appointment_times()
    {
        return $this->hasMany(AppointmentTime::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function vaccine()
    {
        return $this->hasOne(Vaccine::class, 'id', 'vaccine_id');
    }
}
