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
            'name' => 'Admin',
            'password' => Hash::make('123456'),
        ]);

        User::create([
            'name' => 'Yurleis',
            'password' => Hash::make('claveSegura'),
        ]);
    }
}
