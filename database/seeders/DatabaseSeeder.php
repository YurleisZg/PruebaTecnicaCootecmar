<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Luis',
            'password' => Hash::make('0000'),
        ]);

        User::create([
            'name' => 'Gabriel',
            'password' => Hash::make('1111'),
        ]);

        User::create([
            'name' => 'Sergio',
            'password' => Hash::make('2222'),
        ]);
    }
}
