<?php

namespace Database\Seeders;

use App\Models\DiseaseType;
use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@smileclinic.com',
            'password' => bcrypt('123456'),
            'name' => 'Smile Clinic',
            'phone_number' => '123456789',
            'role_id' => 1,
            'id'=> '1',
        ]);
        

       $this->call([RoleSeeder::class, 
                    StateSeeder::class,
                    DiseaseTypeSeeder::class, 
                    TreatmentSeeder::class,
                    DiseaseSeeder::class, 
                    MedicamentSeeder::class, 
                    PatientSeeder::class,
                    SpecialtySeeder::class,
                    DentistSeeder::class,
                    AppointmentSeeder::class,
                    AppointmentTreatmentSeeder::class]);            
    }
}
