<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
            ['name' => 'Ortodoncista', 'description' => 'Anomalías de forma, posición, relación y función'],
            ['name' => 'Rehabiliador Oral', 'description' => 'restauración inmediata de las piezas dentales'],
            ['name'=> 'Endodoncista', 'description' => 'Extirpación de la pulpa dental y el posterior relleno y sellado de la cavidad pulpar'],
            ['name'=> 'Implantologo', 'description' => 'Reemplazo de dientes perdidos mediante la colocación quirúrgica de un implante'],
            ['name'=> 'Cirujano Maxilofacial', 'description' => 'Rehabilitación de las enfermedades congénitas o adquiridas de la cavidad oral, el esqueleto facial y las estructuras cervicales relacionadas'],
            ['name'=> 'Odontopediatra', 'description' => 'Encargado de explorar y tratar a niños y recién nacidos'],
            ['name'=> 'Periodoncista', 'description' => 'Trata las enfermedades de las encías y del hueso que sostiene los dientes']
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
