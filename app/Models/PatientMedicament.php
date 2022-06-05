<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicament extends Model
{
    use HasFactory;

    protected $table="medicament_patient";

}
