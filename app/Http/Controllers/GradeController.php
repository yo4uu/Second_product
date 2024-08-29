<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassMembership;
use App\Models\Evaluation;
use App\Models\EvaluationItem;
use App\Models\Student;
use App\Models\SchoolClass;
use Carbon\Carbon;

class GradeController extends Controller
{
    public function index()
    {
        $currentYear =  Carbon::now()->year;

        if (Carbon::now()->month < 4) {
            $currentYear--;
        }

        // すべてのクラスを取得し、学年およびクラス名でソート
        $schoolclasses = SchoolClass::orderBy('school_grade')
                                    ->orderBy('class_name')
                                    ->get();

        return view('grades.index', compact('currentYear', 'schoolclasses'));
    }

public function show(Request $request)
{
    $currentYear = Carbon::now()->year;

    if (Carbon::now()->month < 4) {
        $currentYear--;
    }

    $grade = $request->input('grade');
    $class = $request->input('class');

    // 指定された学年とクラスに該当するクラス情報を取得
    $schoolClasses = SchoolClass::where('school_grade', $grade)
                                ->where('class_name', $class)
                                ->where('school_year', $currentYear)
                                ->get();

    // 中間テーブルから該当するレコードを取得
    // $memberships = collect();
    // foreach ($schoolClasses as $schoolClass) {
    //     $classMemberships = ClassMembership::where('school_class_id', $schoolClass->id)->get();
    //     $memberships = $memberships->merge($classMemberships);
    // }

    $subjects = [
        '国語',
        '算数',
        '理科',
        '社会',
        '外国語',
        '外国語活動',
        '音楽',
        '図工',
        '体育',
        '家庭科',
        '道徳',
        '総合的な学習の時間',
        '生活' 
    ];

    $item_types = [
        '知識・技能',
        '思考・判断・表現',
        '主体的に学習に取り組む態度',
    ];

    return view('grades.show', compact('schoolClasses', 'subjects', 'item_types', 'grade', 'class'));
}

public function addEvaItem(Request $request)
{
    $validatedData = $request->validate([
        'subject' => 'required|string|max:255',
        'item_name' => 'required|string|max:255',
        'item_type' => 'required|string|max:255',
    ]);

    $currentYear = Carbon::now()->year;

    if (Carbon::now()->month < 4) {
        $currentYear--;
    }

    $grade = $request->input('grade');
    $class = $request->input('class');

    $schoolClass = SchoolClass::where('school_grade', $grade)
                          ->where('class_name', $class)
                          ->where('school_year', $currentYear)
                          ->first(); // 直接オブジェクトを取得

    $schoolClassId = $schoolClass->id; 
    
    $validatedData['school_class_id'] = $schoolClassId;

    // データを保存
    EvaluationItem::create($validatedData);

    return redirect()->back();
}


}
