<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class schoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = ['1組', '2組', '3組', '4組', '5組']; // クラス名
        $grades = [1, 2, 3, 4, 5, 6]; // 学年

        foreach ($grades as $grade) {
            foreach ($classes as $class) {
                SchoolClass::create([
                    'class_name' => $class,
                    'school_grade' => $grade,
                    'school_year' => 2024,
                ]);
            }
        }
    }
}
