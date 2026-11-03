<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $existingAdmin = User::where('email', 'admin@berkahelektronik.com')->first();
        
        if (!$existingAdmin) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@berkahelektronik.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@tokoberkah.com');
            $this->command->info('Password: admin123');
        } else {
            $this->command->info('Admin user already exists!');
        }
    }
}