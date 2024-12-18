<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::create([
            'school' => 'SMA 10 SEMARANG',
        ]);
        School::create([
            'school' => 'SMA KESATRIAN 1 SEMARANG',
        ]);
        School::create([
            'school' => 'SMA 15 SEMARANG',
        ]);
        School::create([
            'school' => 'SMK 2 DEMAK',
        ]);
        School::create([
            'school' => 'SMA 7 SEMARANG',
        ]);
        School::create([
            'school' => 'SMKN 1 SEMARANG',
        ]);
        School::create([
            'school' => 'SMKN 11 SEMARANG',
        ]);
        School::create([
            'school' => 'SMK MUHAMMADIYAH 1',
        ]);
        School::create([
            'school' => 'SMKN 9 SEMARANG',
        ]);
        School::create([
            'school' => 'SMKN 8 SEMARANG',
        ]);
        
    }
}
