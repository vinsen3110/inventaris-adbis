<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data existing jika ada
        User::truncate();

        // Pastikan menggunakan bcrypt atau Hash
        $admin = User::create([
            'name' => 'Admin Inventaris',
            'email' => 'admin@inventaris.com',
            'password' => Hash::make('admin123'), // atau bcrypt('admin123')
            'role' => 'admin'
        ]);

        $user = User::create([
            'name' => 'Staf Inventaris',
            'email' => 'user@inventaris.com',
            'password' => Hash::make('user123'),
            'role' => 'user'
        ]);

        // Debug: Tampilkan informasi akun di console
        $this->command->info('Admin created:');
        $this->command->info('Email: admin@inventaris.com');
        $this->command->info('Password: admin123');
        
        $this->command->info('User created:');
        $this->command->info('Email: user@inventaris.com');
        $this->command->info('Password: user123');
    }
}