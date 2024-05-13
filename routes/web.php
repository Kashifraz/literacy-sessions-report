<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LiteracySessionController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\TopicController;
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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('literacysession', LiteracySessionController::class)->only([
    'create', 'store', 'update', 'destroy'
]);
Route::get('/literacysession/reports', [LiteracySessionController::class, "index"])->name("literacysession.reports");
Route::get('/literacysession/import', [LiteracySessionController::class, "import"])->name("literacysession.import");
Route::post('/literacysession/import', [LiteracySessionController::class, "importData"])->name("literacysession.import");
Route::get('/literacysession/generateword/{id}', [LiteracySessionController::class, "generateWord"])->name("literacysession.word");
Route::post('downloadreport', [LiteracySessionController::class, "downloadReport"])->name("word.download");

Route::resource('campus', CampusController::class)->only([
    'create', 'store', 'update', 'destroy'
]);
Route::resource('department', DepartmentController::class)->only([
    'create', 'store', 'update', 'destroy'
]);
Route::resource('program', ProgramController::class)->only([
    'create', 'store', 'update', 'destroy'
]);
Route::resource('topic', TopicController::class)->only([
    'create', 'store', 'update', 'destroy'
]);
Route::resource('question', QuestionController::class)->only([
    'create', 'store', 'update', 'destroy'
]);
require __DIR__ . '/auth.php';
