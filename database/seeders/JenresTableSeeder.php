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
            ['jenre' => 'サワー'],
            ['jenre' => 'カクテル'],
            ['jenre' => '茶割'],
            ['jenre' => 'ハイボール'],
            ['jenre' => 'ワイン'],
            ['jenre' => '日本酒'],
            ['jenre' => 'ビール'],
        ]);
    }
}
