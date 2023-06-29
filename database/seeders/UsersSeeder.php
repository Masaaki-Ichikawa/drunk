<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' =>'管理者1',
            'email' =>'admin1@test.com',
            'password'=>Hash::make('adminuser1'),
            'role' =>'admin',
        ]);

        User::create([
            'name' =>'ユーザー1',
            'email' =>'user1@test.jp',
            'password'=>Hash::make('user1password'),
            'role' =>'user',
        ]);

        User::factory()
                ->count(20)
                ->create();
    }
}
