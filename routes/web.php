<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\HolidayNotificationController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\Game\WordScrambleController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\Master\BooksController;
use App\Http\Controllers\Master\CategoriesController;
use App\Http\Controllers\Master\MembersController;
use App\Http\Controllers\Master\RaksController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizPlayController;
use App\Http\Controllers\ReturnsController;
use App\Http\Controllers\TerjemahanController;
use App\Http\Controllers\UsersController;
use App\Models\Terjemahan;
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



Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('quiz/{quiz}/questions', [QuestionController::class, 'index'])->name('quiz.questions.index');
    Route::get('quiz/{quiz}/questions/create', [QuestionController::class, 'create'])->name('quiz.questions.create');
    Route::post('quiz/{quiz}/questions', [QuestionController::class, 'store'])->name('quiz.questions.store');
    Route::get('{quiz}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('quiz.questions.edit');
    Route::put('{quiz}/questions/{question}', [QuestionController::class, 'update'])->name('quiz.questions.update');
    Route::delete('{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('quiz.questions.destroy');

    Route::resource('quizzes', QuizController::class);
    Route::resource('questions', QuestionController::class);
    Route::patch('quizzes/{quiz}', [QuizController::class, 'updateQuiz'])->name('quizzes.update');

    // Tambahan Route Baru untuk Management Word Scramble Admin
    Route::resource('scramble-words', WordScrambleController::class);
    Route::get('scramble-settings', [WordScrambleController::class, 'editSettings'])->name('scramble-settings.edit');
    Route::put('scramble-settings', [WordScrambleController::class, 'updateSettings'])->name('scramble-settings.update');





    Route::controller(TerjemahanController::class)
                ->prefix('admin.terjemahan')
                ->name('admin.terjemahan.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/destroy/{id}', 'destroy')->name('destroy');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update/{id}', 'update')->name('update');
    });

    Route::get('/holiday-notifications', [HolidayNotificationController::class, 'index'])->name('admin.holiday.index');
    Route::post('/holiday-notifications', [HolidayNotificationController::class, 'store'])->name('admin.holiday.store');
    Route::delete('/holiday-notifications/{id}', [HolidayNotificationController::class, 'destroy'])->name('admin.holiday.destroy');

    // Motivasi CRUD routes (accessible by admin & superadmin)
    Route::get('admin/motivasi', [DashboardController::class, 'motivasiIndex'])->name('admin.motivasi.index');
    Route::post('admin/motivasi', [DashboardController::class, 'storeMotivasi'])->name('admin.motivasi.store');
    Route::delete('admin/motivasi/{index}', [DashboardController::class, 'deleteMotivasi'])->name('admin.motivasi.destroy');
});
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::controller(DashboardController::class)
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::controller(UsersController::class)
                ->prefix('users')
                ->name('users.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/store', 'store')->name('store');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/update/{id}', 'update')->name('update');
                    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
                });


            
        });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('quiz/{quiz}/start', [QuizPlayController::class, 'start'])->name('quiz.start');
    Route::post('quiz/{quiz}/submit', [QuizPlayController::class, 'submit'])->name('quiz.submit');
});

Route::middleware(['auth', 'role:user'])->prefix('participant')->name('participant.')->group(function () {
    Route::get('/dashboard', [QuizController::class, 'dashboard_user'])->name('user.dashboard');
    Route::get('/quiz', [QuizController::class, 'dashboard'])->name('dashboard');
    Route::get('/quiz/{quiz}', [QuizController::class, 'showTypes'])->name('quiz.types');
    Route::get('/quiz/{quiz}/start/{type}', [QuizController::class, 'start'])->name('quiz.start');
    Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/scramble', function () {
        return view('participant.scramble');
    })->name('scramble.play');
});
Route::middleware(['auth', 'role:user'])->prefix('participant/riwayat')->name('participant.')->group(function () {
    Route::get('/', [QuizController::class, 'riwayat'])->name('riwayat');
    Route::get('/result/{attempt}', [QuizController::class, 'result'])->name('quiz.result');
    Route::get('/result/detail/{attempt}/{type}', [QuizController::class, 'result_detail'])->name('quiz.result.detail');
});


Route::get('/', function () {
    $currentDate = now()->toDateString();
    $activeHoliday = \App\Models\HolidayNotification::where('start_date', '<=', $currentDate)
                        ->where('end_date', '>=', $currentDate)
                        ->get();
    $data = [
        'list' => Terjemahan::all(),
        'activeHoliday' => $activeHoliday
    ];
    return view('welcome', $data);
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
Route::post('/dashboard/motivasi', [DashboardController::class, 'updateMotivasi'])->middleware(['auth', 'role:admin|superadmin'])->name('admin.motivasi.update');

require __DIR__ . '/auth.php';
