<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = [
            [   'name'          => 'Victor',
                'user_id'       =>  '1',
                'phone_number'  => '123456',
                'dni'           => '24337423',
                'email'         => 'ingsanchez423@gmail.com'
            ],
            [   'name'          => 'Harry',
                'user_id'       =>  '1',
                'phone_number'  => '123456',
                'dni'           => '24337420',
                'email'         => 'harrysanchez31@gmail.com'
            ],
            [   'name'          => 'Manuel',
                'user_id'       =>  '1',
                'phone_number'  => '123456',
                'dni'           => '26123456',
                'email'         => 'josuemanuellopezsanchez@gmail.com'

            ]
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
