<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan round_id sesuai dengan yang ada di tabel rounds
        $questions = [
            [
                'content' => 'Darimana alat musik Fu berasal?',
                'options' => json_encode(['a' => 'Sumatra', 'b' => 'Aceh', 'c' => 'Maluku Utara', 'd' => 'Kalimantan']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Kapan Hari Kebangkitan Nasional diperingati?',
                'options' => json_encode(['a' => '5 Mei', 'b' => '2 Juni', 'c' => '20 Mei', 'd' => '18 Juni']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Berapa jumlah program studi di Fakultas Ilmu Komputer UDINUS?',
                'options' => json_encode(['a' => '6', 'b' => '13', 'c' => '5', 'd' => '8']),
                'correct_option' => 'b',
                'round_id' => 1
            ],
            [
                'content' => 'Bahan bakar pesawat?',
                'options' => json_encode(['a' => 'Avtur', 'b' => 'Avgas', 'c' => 'Diesel', 'd' => 'Kerosene']),
                'correct_option' => 'a',
                'round_id' => 1
            ],
            [
                'content' => 'Apa nama sungai terpanjang di Amerika Serikat?',
                'options' => json_encode(['a' => 'Nil', 'b' => 'Amazon', 'c' => 'Missouri', 'd' => 'Mississippi']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Untuk menekan laju pertumbuhan penduduk, pemerintah menggalangkan program?',
                'options' => json_encode(['a' => 'Keluarga Berencana', 'b' => 'Bidik Misi', 'c' => 'Program Keluarga Harapan', 'd' => 'Pemulihan Ekonomi Nasional']),
                'correct_option' => 'a',
                'round_id' => 1
            ],
            [
                'content' => 'Dimana letak Lab Komputer di UDINUS?',
                'options' => json_encode(['a' => 'Gedung A', 'b' => 'Gedung C', 'c' => 'Gedung D', 'd' => 'Gedung H']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Apa nama alat yang digunakan untuk mengukur tekanan udara?',
                'options' => json_encode(['a' => 'Barometer', 'b' => 'Termometer', 'c' => 'Higrometer', 'd' => 'Parameter']),
                'correct_option' => 'a',
                'round_id' => 1
            ],
            [
                'content' => 'Siapakah presiden pertama Amerika Serikat?',
                'options' => json_encode(['a' => 'Joe Biden', 'b' => 'Abraham Lincoln', 'c' => 'James Buchanan', 'd' => 'George Washington']),
                'correct_option' => 'd',
                'round_id' => 1
            ],
            [
                'content' => 'Apa nama Ibukota Australia?',
                'options' => json_encode(['a' => 'Adelaide', 'b' => 'Brisbane', 'c' => 'Canberra', 'd' => 'Sydney']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Apa nama latin dari beras?',
                'options' => json_encode(['a' => 'Zingiber Officinale', 'b' => 'Oryza Sativa', 'c' => 'Mangifera Indica', 'd' => 'Pyrus']),
                'correct_option' => 'b',
                'round_id' => 1
            ],
            [
                'content' => 'Dimana letak gedung Fakultas Ilmu Komputer UDINUS?',
                'options' => json_encode(['a' => 'Gedung H', 'b' => 'Gedung A', 'c' => 'Gedung C', 'd' => 'Gedung I']),
                'correct_option' => 'a',
                'round_id' => 1
            ],
            [
                'content' => 'Ibukota Kabupaten Banyumas adalah?',
                'options' => json_encode(['a' => 'Sokaraja', 'b' => 'Ajibarang', 'c' => 'Purwokerto', 'd' => 'Banyumas']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Raja pertama Mataram Islam adalah?',
                'options' => json_encode(['a' => 'Sultan Hadiwijaya', 'b' => 'Danang Sutowijoyo', 'c' => 'Sultan Agung', 'd' => 'Sultan Hamengkubowono']),
                'correct_option' => 'b',
                'round_id' => 1
            ],
            [
                'content' => 'Pulau Bintan merupakan daerah penghasil?',
                'options' => json_encode(['a' => 'Minyak bumi', 'b' => 'Bauksit', 'c' => 'Kayu', 'd' => 'Batu bara']),
                'correct_option' => 'b',
                'round_id' => 1
            ],
            [
                'content' => 'Semboyan “ing ngarsa sung tuladha, ing madya mangun karsa, tut wuri handayani” dicetuskan oleh....',
                'options' => json_encode(['a' => 'Ki Hajar Dewantoro', 'b' => 'Prof. Dr. Soepomo', 'c' => 'Drs. Moh. Hatta', 'd' => 'Ir. Soekarno', 'e' => 'Mr. Moh. Yamin']),
                'correct_option' => 'a',
                'round_id' => 1
            ],
            [
                'content' => 'Ada berapa banyak organisasi kemahasiswaan yang ada di Fakultas Ilmu Komputer?',
                'options' => json_encode(['a' => '8', 'b' => '9', 'c' => '10', 'd' => '11']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Siapakah nama Menteri Luar Negeri Indonesia Kabinet Merah Putih?',
                'options' => json_encode(['a' => 'Retno Marsudi', 'b' => 'Sugiono', 'c' => 'Budi Gunawan', 'd' => 'Muhammad Tito Karnavian']),
                'correct_option' => 'a',
                'round_id' => 1
            ],
            [
                'content' => 'Fakultas Ilmu Komputer UDINUS memiliki akreditasi apa untuk program studi Teknik Informatika?',
                'options' => json_encode(['a' => 'A', 'b' => 'B', 'c' => 'Unggul', 'd' => 'Baik Sekali']),
                'correct_option' => 'c',
                'round_id' => 1
            ],
            [
                'content' => 'Kota tertua di Jawa Tengah adalah?',
                'options' => json_encode(['a' => 'Magelang', 'b' => 'Semarang', 'c' => 'Solo', 'd' => 'Salatiga']),
                'correct_option' => 'b',
                'round_id' => 1
            ],
            [
                'content' => '12² - (13 x 3) + 15 = …',
                'options' => json_encode(['a' => '120', 'b' => '135', 'c' => '145', 'd' => '125']),
                'correct_option' => 'a',
                'round_id' => 2
            ],
            [
                'content' => '36 + (48 ÷ 12) × 5 = ….',
                'options' => json_encode(['a' => '53', 'b' => '46', 'c' => '56', 'd' => '57']),
                'correct_option' => 'c',
                'round_id' => 2
            ],
            [
                'content' => '1.250 + (800 - 650) = ….',
                'options' => json_encode(['a' => '1.350', 'b' => '1.400', 'c' => '1.450', 'd' => '1.300']),
                'correct_option' => 'b',
                'round_id' => 2
            ],
            [
                'content' => '26 x 450 =.....',
                'options' => json_encode(['a' => '11.802', 'b' => '11.856', 'c' => '10.865', 'd' => '11.700']),
                'correct_option' => 'd',
                'round_id' => 2
            ],
            [
                'content' => '(630 + 270) - (450 + 360) = ….',
                'options' => json_encode(['a' => '80', 'b' => '90', 'c' => '87', 'd' => '805']),
                'correct_option' => 'b',
                'round_id' => 2
            ],
            [
                'content' => '235 + (978 - 345) - 456 = ….',
                'options' => json_encode(['a' => '420', 'b' => '412', 'c' => '440', 'd' => '435']),
                'correct_option' => 'b',
                'round_id' => 2
            ],
            [
                'content' => '(987 + (654 - 432)) - 987 =....',
                'options' => json_encode(['a' => '305', 'b' => '232', 'c' => '223', 'd' => '222']),
                'correct_option' => 'd',
                'round_id' => 2
            ],
            [
                'content' => '(610 + ((640 - 830) + 470)) =.....',
                'options' => json_encode(['a' => '880', 'b' => '820', 'c' => '990', 'd' => '890']),
                'correct_option' => 'd',
                'round_id' => 2
            ],
            [
                'content' => '(420 - 230) + (370 - 150) = ….',
                'options' => json_encode(['a' => '520', 'b' => '410', 'c' => '350', 'd' => '460']),
                'correct_option' => 'b',
                'round_id' => 2
            ],
            [
                'content' => '(860 + 410) - 910 = ….',
                'options' => json_encode(['a' => '360', 'b' => '412', 'c' => '480', 'd' => '392']),
                'correct_option' => 'a',
                'round_id' => 2
            ],
            [
                'content' => '(830 - 280) + (520 - 410) = ....',
                'options' => json_encode(['a' => '550', 'b' => '660', 'c' => '420', 'd' => '430']),
                'correct_option' => 'b',
                'round_id' => 2
            ],
            [
                'content' => '910 - ((460 + 370) - (230 + 120)) = ….',
                'options' => json_encode(['a' => '420', 'b' => '450', 'c' => '430', 'd' => '460']),
                'correct_option' => 'c',
                'round_id' => 2
            ],
            [
                'content' => '((740 - 520) + (670 - 360)) - 250 = ….',
                'options' => json_encode(['a' => '340', 'b' => '280', 'c' => '460', 'd' => '290']),
                'correct_option' => 'b',
                'round_id' => 2
            ],
            [
                'content' => '390 + (710 - ((860 + 240) - 460)) = ….',
                'options' => json_encode(['a' => '390', 'b' => '710', 'c' => '460', 'd' => '340']),
                'correct_option' => 'c',
                'round_id' => 2
            ],
            [
                'content' => '430 + ((520 + 270)) - 360) = ….',
                'options' => json_encode(['a' => '830', 'b' => '860', 'c' => '840', 'd' => '820']),
                'correct_option' => 'b',
                'round_id' => 2
            ],
            [
                'content' => 'Fakultas Ilmu Komputer UDINUS hanya memiliki program studi S1.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'b',
                'round_id' => 3
            ],
            [
                'content' => 'Kip merupakan nama mata uang negara Vietnam.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'b',
                'round_id' => 3
            ],
            [
                'content' => 'Pulau Kalimantan berbatasan langsung dengan negara Malaysia dan Brunei Darussalam.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
            [
                'content' => 'Bahasa Spanyol adalah bahasa resmi di Brasil.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'b',
                'round_id' => 3
            ],
            [
                'content' => 'Puncak tertinggi di dunia adalah Gunung Everest.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
            [
                'content' => 'Jika A lebih besar dari B, dan B lebih besar dari C, maka A lebih besar dari C.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
            [
                'content' => 'Expo BEM Fakultas Ilmu Komputer terletak pada lantai 3.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'b',
                'round_id' => 3
            ],
            [
                'content' => 'Gajah adalah satu-satunya hewan mamalia yang tidak bisa melompat.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
            [
                'content' => 'Prodi Desain Komunikasi Visual (DKV) termasuk dalam Fakultas Ilmu Komputer UDINUS.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
            [
                'content' => 'Pluto adalah planet terkecil dalam tata surya kita.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'b',
                'round_id' => 3
            ],
            [
                'content' => 'Air panas membeku lebih cepat daripada air dingin ketika ditempatkan dalam kondisi yang sama dan dibekukan pada suhu yang sama.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
            [
                'content' => 'Planet Saturnus dapat mengapung di air jika ada kolam raksasa.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
            [
                'content' => 'Isaac Newton menemukan Teori Relativitas.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'b',
                'round_id' => 3
            ],
            [
                'content' => 'Benua Australia adalah benua terbesar di dunia.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'b',
                'round_id' => 3
            ],
            [
                'content' => 'Pulau Jawa adalah pulau dengan jumlah penduduk terbanyak di Indonesia.',
                'options' => json_encode(['a' => 'True', 'b' => 'False']),
                'correct_option' => 'a',
                'round_id' => 3
            ],
        ];

        // Insert all questions
        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}