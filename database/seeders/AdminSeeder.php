<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Abdalluh',
            'email' => 'abdalluhyaseen@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'super_admin',
        ]);

        User::create([
            'name' => 'mohammad',
            'email' => 'mohammad@gmail.com',
            'password' => Hash::make('mohammad123'),
            'role' => 'admin',
        ]);

    }
}

