<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
    ];

    protected $table = 'states';

    public function appointments() {
        return $this->hasMany(Appointment::class, 'state_id', 'id');
    }
}
