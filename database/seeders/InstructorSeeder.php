<?php

namespace Database\Seeders;

use App\Models\Instructor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Instructor::create([
            'name'=>'instructor1',
            'specialty'=>'ite',
            'experience'=>5
        ]);

        Instructor::create([
            'name'=>'instructor2',
            'specialty'=>'network',
            'experience'=>5
        ]);
    }
}
