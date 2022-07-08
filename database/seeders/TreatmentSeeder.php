<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Treatment;

class TreatmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $treatments = [
            ['name' => 'Profilaxis', 'price' => 40.00, 'description' => 'Limpieza dental'],
            ['name' => 'Restauración MOD', 'price' => 40.00, 'description' => 'Área Mesial Oclusal Distal'],
            ['name' => 'Restauracion Distal', 'price' => 80.00, 'description' => 'Área Distal'],
            ['name' => 'Restauracion Mesial', 'price' => 80.00, 'description' => 'Área Mesial'],
            ['name' => 'Endodoncia', 'price' => 200.00, 'description' => 'Comprende incisivos caninos premolares molares'],
            ['name' => 'Retratamiento Endodontico', 'price' => 180.00, 'description' => 'Comprende incisivos caninos premolares molares'],
            ['name' => 'Restauración en poste de fibra de vidrio', 'price' => 120.00, 'description' => 'COmprende del diente 41 al 48'],
            ['name' => 'Cirujía de levantamiento del seno maxilar', 'price' => 300.00, 'description' => 'Cirujia para levantar el sexo maxilar'],
            ['name' => 'Cirujía plastica periodontal', 'price' => 1300.00, 'description' => 'Cirujia plastica del periodontal'],
            ['name' => 'Cirujía de implante con hueso', 'price' => 600.00, 'description' => 'Implante con hueso']
        ];

        foreach ($treatments as $treatment) {
            Treatment::create($treatment);
        }
    }
}
