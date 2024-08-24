<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SchoolClass;

class SchoolClass2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $years = range(2019, 2023);
        $grades = range(1, 6);
        $classes = ['1組', '2組', '3組', '4組', '5組'];

        foreach ($years as $year) {
            foreach ($grades as $grade) {
                foreach ($classes as $className) {
                    SchoolClass::create([
                        'school_year' => $year,
                        'school_grade' => $grade,
                        'class_name' => $className,
                    ]);
                }
            }
        }
    }
}
