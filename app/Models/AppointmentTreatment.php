<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTreatment extends Model
{
    use HasFactory;

    protected $table="appointment_treatment";
    //protected $primaryKey = ['appointment_id', 'treatment_id'];

    protected $fillable = [
        'price',
        'observation',
        'appointment_id',
        'treatment_id'
    ];
}
