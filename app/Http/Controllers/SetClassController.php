<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\SchoolClass;
use App\Models\ClassMembership;

class SetClassController extends Controller
{
    public function index()
    {   
        $selectOptions = [
            '１年生',
            '２年生',
            '３年生',
            '４年生',
            '５年生',
            '６年生',
        ];

        return view('setclass.index', compact('selectOptions'));
    }

    public function filterByGrade(Request $request)
    {
        $selectedGrade = $request->input('selected_grade');

        $currentYear = now()->year;
        if (now()->month < 4) {
            $currentYear--;
        }

        $admissionYear = $currentYear - $selectedGrade + 1;

        $students = Student::where('admission_year', $admissionYear)->get();

        $schoolClasses = SchoolClass::where('school_year', $currentYear)
                                    ->where('school_grade', $selectedGrade)
                                    ->orderBy('class_name', 'asc')
                                    ->distinct('class_name',)
                                    ->pluck('class_name');

        return view('setclass.show', compact('students', 'schoolClasses','selectedGrade'));
    }

    public function create($grade)
    {
        $currentYear = now()->year;
        if (now()->month < 4) {
            $currentYear--;
        }

        $admissionYear = $currentYear - $grade + 1;

        $students = Student::where('admission_year', $admissionYear)->get();

        // $schoolClasses = SchoolClass::where('school_year', $currentYear)
        //                             ->where('school_grade', $grade)
        //                             ->orderBy('class_name', 'asc')
        //                             ->distinct('class_name',)
        //                             ->pluck('class_name');

        // 1. class_nameのリストを取得
        $classNames = SchoolClass::where('school_year', $currentYear)
                         ->where('school_grade', $grade)
                         ->orderBy('class_name', 'asc')
                         ->distinct('class_name')
                         ->pluck('class_name');

        // 2. class_nameのリストを使って対応するレコードを取得
        $schoolClasses = SchoolClass::where('school_year', $currentYear)
                                    ->where('school_grade', $grade)
                                    ->whereIn('class_name', $classNames)
                                    ->get();

        return view('setclass.create', compact('students', 'schoolClasses','grade'));
    }

    public function store(Request $request)
    {
        $classIds = $request->input('class_ids'); // 'class_ids' 配列を取得

        foreach ($classIds as $studentId => $classId) {
            // ここで $studentId は配列のキー、つまり学生のID
            // $classId はその学生に対応するクラスID

            // [
            //     'class_ids' => [
            //         '1' => '6', // student_id => class_id
            //         '2' => '7',
            //         // 他の生徒のデータも同様に送信される
            //     ]
            // ]
            

            $student = Student::find($studentId);

            if ($classId) {
                $student->schoolClasses()->sync([$classId]);
            } else {
                $student->schoolClasses()->detach();
            }
        }


        return redirect()->route('setclass.index')->with('success', 'クラスの振り分けが更新されました。');
    }
}
