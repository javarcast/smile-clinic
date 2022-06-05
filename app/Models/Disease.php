<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'disease_type_id'
    ];

    public function diseaseType() {
        return $this->belongsTo(DiseaseType::class, 'disease_type_id');
    }

    public function patients() {
        return $this->belongsToMany(Patient::class, 'disease_patient')->withTimestamps();
    }
}
