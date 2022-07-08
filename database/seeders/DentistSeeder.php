<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dentist;
class DentistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dentist = [
           'specialty_id'  => 1,
            'user_id'      => 1,
          
        ];

        Dentist::create($dentist);
    }
}
