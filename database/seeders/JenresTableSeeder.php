<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class JenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenres')->insert([
            ['name' => 'サワー'],
            ['name' => 'カクテル'],
            ['name' => '茶割'],
            ['name' => 'ハイボール'],
            ['name' => 'ワイン'],
            ['name' => '日本酒'],
            ['name' => 'ビール'],
        ]);
    }
}
