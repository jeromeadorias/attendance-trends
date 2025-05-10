<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::insert([
            ['name' => 'Alice Johnson'],
            ['name' => 'Bob Smith'],
            ['name' => 'Charlie Lee']
        ]);
    }
}
