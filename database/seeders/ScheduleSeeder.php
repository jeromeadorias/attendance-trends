<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Schedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run(): void
    {
        $math = Course::where('name', 'Mathematics')->first();
        $science = Course::where('name', 'Science')->first();

        Schedule::insert([
            ['course_id' => $math->id, 'day_of_week' => 'Monday', 'start_time' => '08:00:00'],
            ['course_id' => $science->id, 'day_of_week' => 'Wednesday', 'start_time' => '10:00:00'],
        ]);
    }
}
