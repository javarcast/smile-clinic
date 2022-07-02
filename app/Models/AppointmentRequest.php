<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    use HasFactory;

    protected $table = 'appointment_requests';

    protected $fillable = [
        'client_id',
        'description',
        'date_appointment',
        'status',
    ];
}
