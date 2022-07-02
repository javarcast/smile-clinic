<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function user() {
        return $this->belongsTo(User::class, 'client_id');
    }
}
