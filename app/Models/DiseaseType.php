<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseType extends Model
{
    use HasFactory;

    protected $table = 'disease_types';
    protected $fillable = [
        'name',
    ];

}
