<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['category_id' => 1, 'name_category' => 'Undangan', 'description' => 'Surat undangan resmi', 'created_at' => '2025-10-02 03:52:13', 'updated_at' => '2025-10-02 03:53:12'],
            ['category_id' => 2, 'name_category' => 'Pengumuman', 'description' => 'Surat pengumuman penting', 'created_at' => '2025-10-02 03:52:13', 'updated_at' => '2025-10-02 03:52:13'],
            ['category_id' => 3, 'name_category' => 'Nota Dinas', 'description' => 'Surat nota dinas internal', 'created_at' => '2025-10-02 03:52:13', 'updated_at' => '2025-10-02 03:52:13'],
            ['category_id' => 4, 'name_category' => 'Pemberitahuan', 'description' => 'Pemberitahuan Penting', 'created_at' => '2025-10-01 22:10:37', 'updated_at' => '2025-10-01 22:10:37'],
        ]);
    }
}
