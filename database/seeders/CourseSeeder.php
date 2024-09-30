<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::create([
            'title' => 'sofrware Engineering',
            'description' => 'nothing',
            'start_date' => '2024-02-22'

        ]);

        Course::create([
            'title' => 'data Engineering',
            'description' => 'nothing',
            'start_date' => '2024-02-25'
        ]);

        Course::create([
            'title' => 'network Engineering',
            'description' => 'nothing',
            'start_date' => '2024-02-26'
        ]);
    }
}
