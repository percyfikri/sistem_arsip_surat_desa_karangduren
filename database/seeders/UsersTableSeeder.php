<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_id' => 3,
                'username' => 'Yoppy Yunhasnawa',
                'email' => 'yoppy@gmail.com',
                'password' => '$2y$12$6LGkZ/bAkKrLMhqsLK1SDuWH7TehIyqpuqvjvE9dcP.ZhrT1UpM7i',
                'role' => 'user',
                'prodi' => 'D3-MI PSDKU Kediri',
                'nim' => '7411040413',
                'created_at' => '2025-10-02 09:33:45',
                'updated_at' => '2025-10-02 09:33:45'
            ],
        ]);
    }
}
