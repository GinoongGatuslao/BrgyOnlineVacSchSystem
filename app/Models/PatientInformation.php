<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PatientInformation extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthdate',
        'sex',
        'purok_id',
        'contact_number',
        'contact_number_verified',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function purok()
    {
        return $this->hasOne(Purok::class, 'id', 'purok_id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'id');
    }
   

       /**
     * Route notifications for the Vonage channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForVonage($notification)
    {
        return $this->contact_number;
    }
}
