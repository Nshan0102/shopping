<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => "Jhon Doe",
            'username' => "Jhon",
            'email' => "jhone.doe@gmail.com",
            'password' => Hash::make("Jhone#Doe"),
            'calculation_type' => User::CALCULATION_WITH_TAX,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10)
        ]);
        User::factory(10)->create();
        $this->call(ProductSeeder::class);
    }
}
