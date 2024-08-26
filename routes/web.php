<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\YearlyUpdateController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\SetClassController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [TaskController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

//以下タスク追加
Route::post('/task', [TaskController::class, 'store'])->name('task.store');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');

//以下生徒登録
Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
Route::get('/student/importForm', [StudentController::class, 'showImportForm'])->name('student.importForm');
Route::post('/student/import', [StudentController::class, 'import'])->name('student.import');
Route::post('/student/store', [StudentController::class,'store'])->name('student.store');
Route::get('student/{student}/edit', [StudentController::class,'edit'])->name('student.edit');
Route::patch('/student/{student}/update', [StudentController::class, 'update'])->name('student.update');
Route::delete('/student/{student}/destroy', [StudentController::class, 'destroy'])->name('student.destroy');

//以下クラス登録
Route::get('/setclass/index', [SetClassController::class, 'index'])->name('setclass.index');
Route::post('/setclass/show', [SetClassController::class, 'filterByGrade'])->name('setclass.show');
Route::get('/setclass/create/{grade}', [SetClassController::class, 'create'])->name('setclass.create');
Route::post('/setclass/store', [SetClassController::class, 'store'])->name('setclass.store');

//以下設備予約
Route::get('/facility/index',[FacilityController::class, 'index'])->name('facility.index');
Route::post('/facility/reservation', [FacilityController::class, 'store'])->name('reservation.store');

//以下学年・クラス設定(年度更新)
Route::get('/yealyupdate', [YearlyUpdateController::class, 'index'])->name('yearly.index');
Route::delete('/classes/{id}', [YearlyUpdateController::class, 'destroy'])->name('classes.destroy');
Route::post('/classes', [YearlyUpdateController::class, 'store'])->name('classes.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
