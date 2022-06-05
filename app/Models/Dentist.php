<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dentist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty_id'
    ];

    public function specialty() {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointments() {
        return $this->hasMany(Appointment::class, 'dentist_id', 'id');
    }
}
