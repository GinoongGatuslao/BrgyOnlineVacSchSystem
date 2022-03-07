<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purok extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function patient_information()
    {
        return $this->belongsTo(PatientInformation::class);
    }
}
