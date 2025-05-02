<?php

namespace Database\Seeders;

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
        User::create([
            'name' => 'Ibal ',
            'email' => 'ibal@example.com',
            'phone' => '081234567890',

        ]);

        User::create([
            'name' => 'Rina Kusuma',
            'email' => 'rina@example.com',
            'phone' => '089876543210',

        ]);
    }
}
