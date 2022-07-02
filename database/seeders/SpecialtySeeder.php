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
            ['name' => 'Ortodoncista', 'description' => 'hace algo'],
            ['name' => 'Extractor', 'description' => 'hace algo'],
            ['name'=> 'Instrumentalista', 'description' => 'hace algo']
        ];

        foreach ($specialties as $specialty) {
            Specialty::create($specialty);
        }
    }
}
