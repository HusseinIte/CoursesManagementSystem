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
        Student::create([
            'name' => 'student1',
            'email' => 'student1@gmail.com'
        ]);


        Student::create([
            'name' => 'student2',
            'email' => 'student2@gmail.com'
        ]);


        Student::create([
            'name' => 'student3',
            'email' => 'student3@gmail.com'
        ]);

        Student::create([
            'name' => 'student4',
            'email' => 'student4@gmail.com'
        ]);
    }
}
