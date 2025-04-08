<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'David',
            'lastname' => 'Alvarez',
            'role_id' => 1,
            'rut' => '123456789',
            'phone' => '123456789',
            'email' => 'test@test.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
