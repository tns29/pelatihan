<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\AdminLevel;
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

        AdminLevel::create([
            'id' => '1',
            'name' => 'Administrator',
        ]);
        
        AdminLevel::create([
            'id' => '2',
            'name' => 'Staff',
        ]);

        Admin::create([
            'number' => 'ADM202311050001',
            'fullname' => 'Admin Utama',
            'username' => 'admin_123',
            'gender' => 'M',
            'no_telp' => '08986564321',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('111111'),
            'level_id' => 1,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => 'admin_123',
        ]);

        Setting::create([
            'id'=> 1,
            'name' => 'Tanggal Pendaftaran'
        ]);
        
        Setting::create([
            'id'=> 2,
            'name' => 'Tanggal Pelatihan'
        ]);

    }
}
