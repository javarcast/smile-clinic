<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Medicament;

class MedicamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medicaments = [
            ['name' => 'Penicilina'],
            ['name' => 'Antidepresivo'],
            ['name' => 'Anticoagulante'],
            ['name' => 'Hipertensivo'],
            ['name' => 'Analgésicos'],
            ['name' => 'Antipiréticos'],
            ['name' => 'Antialérgicos'],
        ];

        foreach ($medicaments as $medicament) {
            Medicament::create($medicament);
        }
    }
}
