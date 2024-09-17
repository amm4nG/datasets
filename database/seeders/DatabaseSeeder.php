<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'full_name' => 'Test Example',
            'email' => 'test@example.com',
            'role' => 'admin',
            'password' => Hash::make('12345678')
        ]);
        // $this->call([CharacteristicSeeder::class, AssociatedTaskSeeder::class, FeatureTypeSeeder::class, SubjectAreaSeeder::class]);
    }
}
