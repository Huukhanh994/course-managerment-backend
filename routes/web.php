<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ExamStructureController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamsController;
use App\Http\Controllers\QuestionsController;
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

Route::get('/', [SubjectController::class, 'index'])->name('index');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::prefix('subjects')->name('subjects.')->group(function () {
    Route::get('/', [SubjectController::class, 'index'])->name('index');
    Route::post('/store', [SubjectController::class, 'store'])->name('store');
    Route::post('/update', [SubjectController::class, 'update'])->name('update');
    Route::post('/{subject}/delete', [SubjectController::class, 'delete'])->name('delete');
});
Route::prefix('chapters')->name('chapters.')->group(function () {
    Route::post('/store', [ChapterController::class, 'store'])->name('store');
    Route::post('/update', [ChapterController::class, 'update'])->name('update');
    Route::post('/{chapter}/delete', [ChapterController::class, 'delete'])->name('delete');
    Route::get('/{subject}/get-chapter', [ChapterController::class, 'getChapter'])->name('getChapter');
});
Route::prefix('questions')->name('questions.')->group(function () {
    Route::get('/', [QuestionsController::class, 'index'])->name('index');
    Route::post('form', [QuestionsController::class, 'form'])->name('form');
    Route::post('/store', [QuestionsController::class, 'store'])->name('store');
    Route::post('{question}/update', [QuestionsController::class, 'update'])->name('update');
    Route::get('/delete/{questionId}', [QuestionsController::class, 'delete'])->name('delete');
    Route::get('answers/{question}/add', [QuestionsController::class, 'addAnswers'])->name('answers.add');
    Route::post('answers/{question}/store', [QuestionsController::class, 'storeAnswers'])->name('answers.store');
});
Route::prefix('exams')->name('exams.')->group(function () {
    Route::get('/', [ExamsController::class, 'index'])->name('index');
    Route::post('/store', [ExamsController::class, 'store'])->name('store');
    Route::post('/{exam}/update', [ExamsController::class, 'update'])->name('update');
    Route::get('/delete/{examId}', [ExamsController::class, 'delete'])->name('delete');
    Route::post('/storeRandom', [ExamsController::class, 'storeRandom'])->name('storeRandom');
});
Route::prefix('exam-structures')->name('exam_structures.')->group(function () {
    Route::get('/', [ExamStructureController::class, 'index'])->name('index');
    Route::post('/store', [ExamStructureController::class, 'store'])->name('store');
    Route::post('/storeExamStructure', [ExamStructureController::class, 'storeExamStructure'])->name('storeExamStructure');
    Route::get('{exam}/show', [ExamStructureController::class, 'show'])->name('show');
    Route::get('/{exam}/random', [ExamStructureController::class, 'randomExam'])->name('random');
    Route::get('{exam}/downloadPdf', [ExamStructureController::class, 'downloadPdf'])->name('downloadPdf');
    Route::get('/delete/{examStructureId}', [ExamStructureController::class, 'delete'])->name('delete');
    Route::post('/{id}/update', [ExamStructureController::class, 'update'])->name('update');
});

Route::prefix('answers')->name('answers.')->group(function () {
    Route::get('/', [AnswersController::class, 'index'])->name('index');
    Route::post('/{answer}/update', [AnswersController::class, 'update'])->name('update');
    Route::post('/store', [AnswersController::class, 'store'])->name('store');
    Route::get('/delete/{answerId}', [AnswersController::class, 'delete'])->name('delete');
    Route::get('/changeCorrect/{answerId}', [AnswersController::class, 'changeCorrect'])->name('changeCorrect');
    Route::get('/changeActive/{answerId}', [AnswersController::class, 'changeActive'])->name('changeActive');
});
require __DIR__ . '/auth.php';
