<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Disease;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diseases = [
            ['name' => 'AINE', 'disease_type_id' => 1],
            ['name' => 'Insulina NPH', 'disease_type_id' => 1],
            ['name' => 'Insulina Cristalina', 'disease_type_id' => 1],
            ['name' => 'Penicilina', 'disease_type_id' => 1],
            ['name' => 'Sulfamidas', 'disease_type_id' => 1],
            ['name' => 'Diabetes', 'disease_type_id' => 2],
            ['name' => 'Hipocondríaco', 'disease_type_id' => 2],
            ['name' => 'Hipertensión', 'disease_type_id' => 2],
            ['name' => 'Unsuficiencia Renal', 'disease_type_id' => 2],
        ];

        foreach ($diseases as $disease) {
            Disease::create($disease);
        }
    }
}
