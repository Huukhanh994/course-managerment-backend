<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamStructureController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::prefix('subjects')->name('subjects.')->group(function () {
    Route::get('/', [SubjectController::class, 'index'])->name('index');
    Route::post('/store', [SubjectController::class, 'store'])->name('store');
    Route::post('/{subject}/delete', [SubjectController::class, 'delete'])->name('delete');
});
Route::prefix('chapters')->name('chapters.')->group(function () {
    Route::post('/store', [ChapterController::class, 'store'])->name('store');
    Route::delete('/{chapter}/delete', [ChapterController::class, 'delete'])->name('delete');
});
Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('index');
    Route::post('/store', [QuestionController::class, 'store'])->name('store');
    Route::delete('/{question}/delete', [QuestionController::class, 'delete'])->name('delete');
});
Route::prefix('exams')->name('exams.')->group(function () {
    Route::get('/', [ExamController::class, 'index'])->name('index');
    Route::post('/store', [ExamController::class, 'store'])->name('store');
    Route::delete('/{exam}/delete', [ExamController::class, 'delete'])->name('delete');
});
Route::prefix('exam-structures')->name('exam_structures.')->group(function () {
    Route::get('/', [ExamStructureController::class, 'index'])->name('index');
    Route::post('/store', [ExamStructureController::class, 'store'])->name('store');
    Route::delete('/{exam_structure}/delete', [ExamStructureController::class, 'delete'])->name('delete');
});
