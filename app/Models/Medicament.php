<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function Patients() {
        return $this->belongsToMany(Patient::class, 'medicament_patient')->withTimestamps();
    }
}
