<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Employee;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $managerPosition = Position::factory()->create([
            'position' => 'Manager',
            'rate' => 40.00,
        ]);

        User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Admin',
            'phone' => '09121244888',
            'address' => 'Sagbayan, Bohol',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(10), // Generating a random token
            'email_verified_at' => now(), // Marking the email as verified
        ]);

        $manager = User::factory()->create([
            'firstName' => 'Test',
            'lastName' => 'Manager',
            'phone' => '09121244888',
            'address' => 'Sagbayan, Bohol',
            'email' => 'employee@test.com',
            'password' => bcrypt('password123'),
            'remember_token' => Str::random(10), // Generating a random token
            'email_verified_at' => now(), // Marking the email as verified
        ]);

        Employee::factory()->create([
            'pos_id' => $managerPosition->id,
            'user_id' => $manager->id,
        ]);


        $this->call([
            RolesandPermissionSeeder::class,
            // UserSeeder::class
        ]);


    }
}
