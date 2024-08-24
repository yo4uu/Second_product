<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolClass;
use Carbon\Carbon;

class YearlyUpdateController extends Controller
{
    public function index(Request $request)
    {
        $currentYear = $request->input('year', Carbon::now()->year);

        if (Carbon::now()->month < 4) {
            $currentYear--;
        }

        // すべてのクラスを取得し、学年およびクラス名でソート
        $schoolclasses = SchoolClass::orderBy('school_grade')
                                    ->orderBy('class_name')
                                    ->get();

        // Bladeにデータを渡す
        return view('yearly.index', compact('currentYear', 'schoolclasses'));
    }

    public function destroy($id)
{
    $class = SchoolClass::findOrFail($id);
    $class->delete();

    return response()->json(['status' => 'success']);
}

public function store(Request $request)
{
    $maxClassNumber = SchoolClass::where('school_grade', $request->input('school_grade'))
                                 ->where('school_year', $request->input('school_year'))
                                 ->count();

    $newClassName = ($maxClassNumber + 1) . '組';

    SchoolClass::create([
        'school_year' => $request->input('school_year'),
        'school_grade' => $request->input('school_grade'),
        'class_name' => $newClassName,
    ]);

    return response()->json(['status' => 'success']);
}

}
