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
        $course = [
            'Matematicas',
            'Programacion',
            'Base de datos',
            'Sistemas Operativos',
            'Redes',
            'Sistemas Operativos',
            'Redes',
        ];

        foreach ($course as $name) {
            Course::updateOrCreate([
                'name' => $name,
                'name' => $name,
            ]);
        }
    }
}
