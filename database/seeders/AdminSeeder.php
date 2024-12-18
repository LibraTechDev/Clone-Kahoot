<?php

namespace Database\Seeders;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Minprim',
            'email' => 'primavieri@gmail.com',
            'password' => bcrypt('12345678'), // Jangan lupa untuk mengenkripsi password
        ]);
    }
}