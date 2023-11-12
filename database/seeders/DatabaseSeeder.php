<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AdminLevel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        AdminLevel::create([
            'id' => '1',
            'name' => 'Manager',
        ]);
        
        AdminLevel::create([
            'id' => '2',
            'name' => 'Leader',
        ]);

        AdminLevel::create([
            'id' => '3',
            'name' => 'Staff',
        ]);
    }
}
