<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;



class StudentController extends Controller
{
    public function index()
   {
    $students = Student::all();
    //  $students = Student::orderBy('admission_year', 'asc')->get();
    //  $schoolClasses = SchoolClass::all();

    return view('student.index', compact('students'));

   }

   public function create()
   {
    return view('student.create');
   }

   public function showImportForm() {
    return view('student.importForm');
  }

    public function import(Request $request)
    {
        // ファイルのバリデーション
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');

            try {
                // トランザクションの開始
                DB::beginTransaction();

                $csv = Reader::createFromPath($file->getPathname(), 'r');
                $csv->setHeaderOffset(0); // CSVの1行目をヘッダーとして扱う

                foreach ($csv as $row) {
                    // データベースに保存
                    \App\Models\Student::create([
                        'name' => $row['名前'],
                        'sex' => $row['性別'],
                        'date_of_birth' => $row['誕生日'],
                        'adress' => $row['住所'],
                        'admission_year' => $row['入学年度'],
                        'email' => $row['メールアドレス'],
                    ]);
                }

                // コミット
                DB::commit();

                return redirect()->route('student.index')->with('success', 'CSVファイルのインポートが成功しました。');
            } catch (\Exception $e) {
                // 例外が発生した場合はロールバック
                DB::rollBack();

                return redirect()->route('student.importForm')->with('error', 'インポート中にエラーが発生しました: ' . $e->getMessage());
            }
        }

        return redirect()->route('student.importForm')->with('error', 'CSVファイルをアップロードしてください。');
    }

   public function store(Request $request)
   {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'sex' => 'required|string|max:10',
        'adress' => 'required|string|max:255',
        'admission_year' => 'required|integer',
        'email' => 'nullable|email|max:255',
    ]);

    Student::create($validatedData);

    return redirect(route('student.index'));
   }

   public function edit(Student $student)
   {
    return view('student.edit',compact('student')); 
   }

   public function update(Request $request, Student $student)
   {
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'date_of_birth' => 'required|date',
        'sex' => 'required|string|max:10',
        'adress' => 'required|string|max:255',
        'admission_year' => 'required|integer',
        'email' => 'nullable|email|max:255',
    ]);

    $student->name = $validatedData['name'];
    $student->date_of_birth = $validatedData['date_of_birth'];
    $student->sex = $validatedData['sex'];
    $student->adress = $validatedData['adress'];
    $student->admission_year = $validatedData['admission_year'];
    $student->email = $validatedData['email'];    

    $student->save();


    return redirect(route('student.index'));
   }

   public function destroy(Student $student) 
   {
    $student->delete();

    return redirect(route('student.index'));
   }
}
