<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'hour',
        'total',
        'state_id',
        'dentist_id',
        'patient_id',
    ];



    public function Treatments() {
        return $this->belongsToMany(Treatment::class, 'appointment_treatment')->withTimestamps();
    }

    public function state() {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function dentist() {
        return $this->belongsTo(Dentist::class, 'dentist_id');
    }

    public function patient() {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
