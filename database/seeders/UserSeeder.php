<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10)->create(); 

        User::create([
            'name' => 'Eyo Akak',
            'email' => 'favourakak@gmail.com',
            'password' => Hash::make('1234'),
        ]);
    }
}
