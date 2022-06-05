<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
    ];


    public function Dentists() {
        return $this->hasMany(Dentist::class, 'specialty_id', 'id');
    }
}
