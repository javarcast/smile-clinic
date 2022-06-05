<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\DiseaseType;

class DiseaseTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diseaseTypes = [
            ['name' => 'Alergia'],
            ['name' => 'Enfermedad'],
        ];

        foreach ($diseaseTypes as $diseaseType) {
            DiseaseType::create($diseaseType);
        }
    }
}
