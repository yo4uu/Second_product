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
    $schoolClasses = SchoolClass::with(['students', 'evaluationItems' => function ($query) {
        $query->with('evaluations'); // evaluationsもロード
    }])
    ->where('school_grade', $grade)
    ->where('class_name', $class)
    ->where('school_year', $currentYear)
    ->get();

    // 各クラスの評価項目を取得
    $evaluationItems = $schoolClasses->flatMap->evaluationItems;

    $subjects = [
        '国語', '算数', '理科', '社会', '外国語', '外国語活動',
        '音楽', '図工', '体育', '家庭科', '道徳', '総合的な学習の時間', '生活'
    ];

    $item_types = [
        '知識・技能', '思考・判断・表現', '主体的に学習に取り組む態度',
    ];

    return view('grades.show', compact('schoolClasses', 'subjects', 'item_types', 'grade', 'class', 'evaluationItems'));
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

public function store(Request $request)
{
    // バリデーション
    $validatedData = $request->validate([
        'evaluations.*.*' => 'required|integer|min:0|max:100',
    ]);

    // 点数の保存
    foreach ($validatedData['evaluations'] as $studentId => $evaluationItems) {
        foreach ($evaluationItems as $itemId => $score) {
            // `student_id` と `evaluation_item_id` でデータを作成または更新
            Evaluation::updateOrCreate(
                [
                    'student_id' => (int)$studentId, // データ型を確認
                    'evaluation_item_id' => (int)$itemId
                ],
                ['score' => (int)$score] // スコアもデータ型を確認
            );
        }
    }

    return redirect()->back()->with([
        'success' => '評価が保存されました！',
        'showToast' => true, // トーストを表示するフラグ
    ]);
}






}
