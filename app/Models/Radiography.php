<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiography extends Model
{
    use HasFactory;

    protected $table ="radiographs";

    protected $fillable = [
        'name',
        'type',
        'url',
        'size',
        'medical_history_id'
    ];

    public function role() {
        return $this->belongsTo(MedicalHistory::class, 'medical_history_id');
    }

}
