<?php

namespace Database\Seeders;

use App\Models\DiseaseType;
use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([RoleSeeder::class, StateSeeder::class,
                    DiseaseTypeSeeder::class, TreatmentSeeder::class,
                    DiseaseSeeder::class, MedicamentSeeder::class]);
                    User::factory()->create([
                        'email' => 'admin@smileclinic.com',
                        'password' => bcrypt('123456'),
                        'name' => 'Smile Clinic',
                        'phone_number' => '123456789',
                        'role_id' => 1,
                        'id'=> '1',
                    ]);
                    User::factory()->create([
                        'email' => 'paola@smileclinic.com',
                        'password' => bcrypt('123456'),
                        'name' => 'Paola',
                        'phone_number' => '123456789',
                        'role_id' => 2,
                        'id'=> '20624646',
                    ]);

            $this->call([SpecialtySeeder::class]);
    }
}
