<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Round;
use App\Models\Question;
use App\Models\School;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\AdminSeeder; // Import AdminSeeder
use Database\Seeders\RoundSeeder; // Import RoundSeeder
use Database\Seeders\QuestionSeeder; // Import QuestionSeeder
use Database\Seeders\SchoolSeeder; 
use Database\Seeders\UserSeeder; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed Admin
        $this->call(AdminSeeder::class);

        // Seed Round
        $this->call(RoundSeeder::class);

        // Seed School
        $this->call(SchoolSeeder::class);

        // Seed Questions
        $this->call(QuestionSeeder::class);

        $this->call(UserSeeder::class);
        
    }
}