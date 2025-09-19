<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\FineController;
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

Route::middleware(['role:superadmin|admin'])->group(function() {
    Route::resource('quizzes', QuizController::class);
    Route::resource('questions', QuestionController::class);
});

Route::middleware(['role:user'])->group(function() {
    Route::get('quiz/{quiz}/start', [QuizPlayController::class, 'start'])->name('quiz.start');
    Route::post('quiz/{quiz}/submit', [QuizPlayController::class, 'submit'])->name('quiz.submit');
});

Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::get('quiz/{quiz}/questions', [QuestionController::class, 'index'])->name('quiz.questions.index');
    Route::get('quiz/{quiz}/questions/create', [QuestionController::class, 'create'])->name('quiz.questions.create');
    Route::post('quiz/{quiz}/questions', [QuestionController::class, 'store'])->name('quiz.questions.store');
    Route::get('{quiz}/questions/{question}/edit', [QuestionController::class, 'edit'])->name('quiz.questions.edit');
    Route::put('{quiz}/questions/{question}', [QuestionController::class, 'update'])->name('quiz.questions.update');
    Route::delete('{quiz}/questions/{question}', [QuestionController::class, 'destroy'])->name('quiz.questions.destroy');
});

Route::middleware(['auth', 'role:user'])->prefix('participant')->name('participant.')->group(function () {
    Route::get('/dashboard', [QuizController::class, 'dashboard_user'])->name('user.dashboard');
    Route::get('/quiz', [QuizController::class, 'dashboard'])->name('dashboard');
    Route::get('/riwayat', [QuizController::class, 'riwayat'])->name('riwayat');
    Route::get('/quiz/{quiz}', [QuizController::class, 'showTypes'])->name('quiz.types');
    Route::get('/quiz/{quiz}/start/{type}', [QuizController::class, 'start'])->name('quiz.start');
    Route::post('/quiz/{quiz}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/result/{attempt}', [QuizController::class, 'result'])->name('quiz.result');
    Route::get('/quiz/result/{attempt}', [QuizController::class, 'result'])->name('quiz.result');
    Route::get('/quiz/result/detail/{attempt}/{type}', [QuizController::class, 'result_detail'])->name('quiz.result.detail');

});


Route::get('/', function () {
    $data = [
        'list' => Terjemahan::all()
    ];
    return view('welcome',$data);
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
   
    

    Route::controller(DashboardController::class)
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            // master data
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
                
          
            Route::controller(TerjemahanController::class)
                ->prefix('terjemahan')
                ->name('terjemahan.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/destroy/{id}', 'destroy')->name('destroy');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update/{id}', 'update')->name('update');

                });
         
        });
});

require __DIR__ . '/auth.php';
