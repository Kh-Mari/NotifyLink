<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create default admin user
        User::firstOrCreate(
            ['email' => 'admin@Notify.com'],
            [
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );
    }
}
