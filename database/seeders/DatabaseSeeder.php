<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\LoginHistory;
use App\Models\Section;
use App\Models\Strand;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::factory()->create([
            'full_name' => 'Administrator',
            'username' => 'admin',
            'password' => bcrypt('admin')
        ]);

        Admin::factory(5)->create();

        Strand::factory()->create([
            'strand' => 'STEM'
        ]);

        Strand::factory()->create([
            'strand' => 'TVL HE'
        ]);

        Strand::factory()->create([
            'strand' => 'TVL ICT'
        ]);

        Strand::factory()->create([
            'strand' => 'HUMSS'
        ]);

        Strand::factory()->create([
            'strand' => 'GAS'
        ]);
        
        Section::factory()->create([
            'section' => 'A - 11'
        ]);

        Section::factory()->create([
            'section' => 'A - 12'
        ]);

        Section::factory()->create([
            'section' => 'B - 11'
        ]);

        Section::factory()->create([
            'section' => 'B - 12'
        ]);

        Section::factory()->create([
            'section' => 'C - 11'
        ]);

        Section::factory()->create([
            'section' => 'C - 12'
        ]);

        Section::factory()->create([
            'section' => 'D - 11'
        ]);

        Section::factory()->create([
            'section' => 'D - 12'
        ]);

        Section::factory()->create([
            'section' => 'E - 11'
        ]);

        Section::factory()->create([
            'section' => 'E - 12'
        ]);

        Teacher::factory(8)->create();

        Student::factory(10)->create();
    }
}
