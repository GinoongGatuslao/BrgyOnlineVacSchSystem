<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTime extends Model
{
    use HasFactory;

    protected $fillable=[
        'appointment_date_id',
        'time_slot',
    ];

    public function appointment_dates()
    {
        return $this->belongsTo(AppointmentDate::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
