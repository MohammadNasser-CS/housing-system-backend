<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;



class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = User::where('role', 'طالب')->get();

        // إنشاء سجلات الطلاب المرتبطة
        $students->each(function ($student) {
            Student::factory()->create(['userId' => $student->id]);
        });
    }
}
