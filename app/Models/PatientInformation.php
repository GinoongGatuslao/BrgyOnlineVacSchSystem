<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInformation extends Model
{
    use HasFactory;

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
        return $this->hasOne(User::class);
    }

    public function purok()
    {
        return $this->hasOne(Purok::class, 'id', 'purok_id');
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }
}
