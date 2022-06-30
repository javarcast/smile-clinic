<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'user_id',
    ];

    protected $table = 'patients';
    protected $primaryKey = 'id';

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medicalHistory() {
        return $this->hasOne(MedicalHistory::class);
    }

    public function diseases() {
        return $this->belongsToMany(Disease::class, 'disease_patient')->withTimestamps();
    }

    public function appointments() {
        return $this->hasMany(Patient::class, 'patient_id', 'id');
    }

    public function Medicaments() {
        return $this->belongsToMany(Medicament::class, 'medicament_patient')->withTimestamps();
    }

}
