<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('Amel123#'),
            'is_admin' => true, 
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user123@gmail.com',
            'password' => Hash::make('Amel123#'),
            'is_admin' => false,
        ]);
    }
    
}
