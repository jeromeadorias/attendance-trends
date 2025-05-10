<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        $entries = [
            [
                'date' => '2024-05-01',
                'student_name' => 'Alice Johnson',
                'course_name' => 'Mathematics',
                'day_of_week' => 'Monday',
                'time' => '08:00:00',
                'status' => 'present',
            ],
            [
                'date' => '2024-05-01',
                'student_name' => 'Bob Smith',
                'course_name' => 'Mathematics',
                'day_of_week' => 'Monday',
                'time' => '08:05:00',
                'status' => 'late',
            ],
            [
                'date' => '2024-05-02',
                'student_name' => 'Charlie Lee',
                'course_name' => 'Science',
                'day_of_week' => 'Wednesday',
                'time' => '10:10:00',
                'status' => 'present',
            ],
            [
                'date' => '2024-05-02',
                'student_name' => 'Alice Johnson',
                'course_name' => 'Science',
                'day_of_week' => 'Wednesday',
                'time' => '10:30:00',
                'status' => 'absent',
            ],
            [
                'date' => '2024-05-03',
                'student_name' => 'Bob Smith',
                'course_name' => 'Mathematics',
                'day_of_week' => 'Monday',
                'time' => '08:01:00',
                'status' => 'present',
            ],
            [
                'date' => '2024-05-03',
                'student_name' => 'Charlie Lee',
                'course_name' => 'Mathematics',
                'day_of_week' => 'Monday',
                'time' => '08:20:00',
                'status' => 'late',
            ],
            [
                'date' => '2024-05-04',
                'student_name' => 'Alice Johnson',
                'course_name' => 'Science',
                'day_of_week' => 'Wednesday',
                'time' => '10:00:00',
                'status' => 'present',
            ],
            [
                'date' => '2024-05-04',
                'student_name' => 'Bob Smith',
                'course_name' => 'Science',
                'day_of_week' => 'Wednesday',
                'time' => '10:20:00',
                'status' => 'absent',
            ],
            [
                'date' => '2024-05-05',
                'student_name' => 'Charlie Lee',
                'course_name' => 'Mathematics',
                'day_of_week' => 'Monday',
                'time' => '08:10:00',
                'status' => 'late',
            ],
            [
                'date' => '2024-05-06',
                'student_name' => 'Alice Johnson',
                'course_name' => 'Mathematics',
                'day_of_week' => 'Monday',
                'time' => '08:00:00',
                'status' => 'present',
            ],
        ];

        foreach ($entries as $entry) {
            // Ensure the student exists
            $student = Student::firstOrCreate(['name' => $entry['student_name']]);

            // Ensure the course exists
            $course = Course::firstOrCreate(['name' => $entry['course_name']]);

            // Ensure the schedule exists
            $schedule = Schedule::firstOrCreate([
                'course_id' => $course->id,
                'day_of_week' => $entry['day_of_week'],
                'start_time' => $entry['time'],
            ]);

            // If any model is missing (highly unlikely due to firstOrCreate), throw an error
            if (!$student || !$course || !$schedule) {
                throw new \Exception("Missing related data for attendance entry: " . json_encode($entry));
            }

            // Create the attendance record
            Attendance::create([
                'student_id' => $student->id,
                'schedule_id' => $schedule->id,
                'date' => $entry['date'],
                'status' => $entry['status'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
