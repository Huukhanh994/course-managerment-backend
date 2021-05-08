<?php

use App\Http\Controllers\AnswersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ExamStructureController;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

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
    Route::get('/', [QuestionsController::class, 'index'])->name('index');
    Route::post('form', [QuestionsController::class, 'form'])->name('form');
    Route::post('/store', [QuestionsController::class, 'store'])->name('store');
    Route::post('{question}/update', [QuestionsController::class, 'update'])->name('update');
    Route::get('/delete/{question}', [QuestionsController::class, 'delete'])->name('delete');
    Route::get('answers/{question}/add', [QuestionsController::class, 'addAnswers'])->name('answers.add');
    Route::post('answers/{question}/store', [QuestionsController::class, 'storeAnswers'])->name('answers.store');
});
Route::prefix('exams')->name('exams.')->group(function () {
    Route::get('/', [ExamsController::class, 'index'])->name('index');
    Route::post('/store', [ExamsController::class, 'store'])->name('store');
    Route::get('/delete/{exam}', [ExamsController::class, 'delete'])->name('delete');
});
Route::prefix('exam-structures')->name('exam_structures.')->group(function () {
    Route::get('/', [ExamStructureController::class, 'index'])->name('index');
    Route::post('/store', [ExamStructureController::class, 'store'])->name('store');
    Route::get('{exam}/show', [ExamStructureController::class, 'show'])->name('show');
    Route::get('{exam}/random', [ExamStructureController::class, 'randomExam'])->name('random');
    Route::get('{exam}/downloadPdf', [ExamStructureController::class, 'downloadPdf'])->name('downloadPdf');
    Route::delete('/{exam_structure}/delete', [ExamStructureController::class, 'delete'])->name('delete');
});

Route::prefix('answers')->name('answers.')->group(function () {
    Route::get('/', [AnswersController::class, 'index'])->name('index');
});
require __DIR__ . '/auth.php';
