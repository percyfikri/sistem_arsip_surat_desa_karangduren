<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LettersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('letters')->insert([
            [
                'letter_id' => 9,
                'nomor_surat' => '2022/PD3/TU/002',
                'category_id' => 1,
                'title' => 'Undahan Halal Bi Halal',
                'path' => 'arsip/2022/PD3/TU/002_Lembar_Pengesahan-Seminar_Proposal.pdf',
                'created_at' => '2025-10-01 21:51:00',
                'updated_at' => '2025-10-01 23:44:05'
            ],
            [
                'letter_id' => 10,
                'nomor_surat' => '2022/PD3/TU/001',
                'category_id' => 3,
                'title' => 'Nota Dinas WFH',
                'path' => 'arsip/2022/PD3/TU/001_2025___Conference___Otomatisasi_Pembelajaran_PHP_Topik_Restful_API__Sukma___Copy_.pdf',
                'created_at' => '2025-10-01 21:51:27',
                'updated_at' => '2025-10-01 23:43:28'
            ],
        ]);
    }
}
