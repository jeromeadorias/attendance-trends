<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Alice Johnson',
            'Bob Smith',
            'Charlie Lee',
            'David White',
            'Emily Green',
            'Frank Black',
            'Grace Blue',
            'Harry Brown',
            'Ivy Gray',
            'Jack Red',
        ];

        foreach ($names as $name) {
            Student::firstOrCreate(['name' => $name]);
        }
    }
}
