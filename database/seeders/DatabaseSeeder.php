<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'first_name' => 'Test User',
            'last_name' => 'test@example.com',
            'email' => 'test@example.com',
            "email_verified_at" => now(),
            "email_verification_code" =>"$2y$12l1AaORPvbaxEw1NijIfKeypxX8D5zGUEj63hLaZ3WtXXWi8qKtqs" ,
            "phone" => "012054575289" ,
            "password" => 12345678 ,
            "gender" => 1,
            "image" => "a.jbg",
            "birth_date" => "1998-03-01",
            "address" => "Egypt"
        ]);
    }
}
