<?php
namespace Database\Seeders;
use App\Models\Round;
use Illuminate\Database\Seeder;

class RoundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Round::create([
            'name' => 'ROUND 1',
            'description' => '- Peserta 200  Penyisihan 100
                                - 15 Menit 
                                - 20 Bank soal -> pilihan ganda A,B,C,D
                                - Soal Pengetahuan Umum 
                                ',
            'duration' => 900,
            'qualification' => 100,
        ]);
        Round::create([
            'name' => 'ROUND 2',
            'description' => '-  Peserta 40 penyisihan 10
                              -  30 Menit 
                              - 15 Soal -> pilihan ganda A,B,C,D
                              - Soal Matematika Basic 
                                ',
            'duration' => 1800,
            'qualification' => 40,
        ]);
        Round::create([
            'name' => 'ROUND 3',
            'description' => '- Peserta 100 penyisihan 40
                              -  15 Menit 
                              - 15 Soal -> pilihan ganda A,B,C,D
                              - Soal True or False
 
                                ',
            'duration' => 900,
            'qualification' => 10,
        ]);
    }
}