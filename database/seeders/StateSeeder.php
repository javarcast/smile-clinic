<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['name' => 'Cancelado'],
            ['name' => 'Pendiente'],
            ['name'=> 'Pospuesta'],
            ['name'=> 'Completada']
        ];

        foreach ($states as $state) {
            State::create($state);
        }
    }
}
