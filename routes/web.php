<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\Master\BooksController;
use App\Http\Controllers\Master\CategoriesController;
use App\Http\Controllers\Master\MembersController;
use App\Http\Controllers\Master\RaksController;
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

Route::get('/', function () {
    $data = [
        'list' => Terjemahan::all()
    ];
    return view('welcome',$data);
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::controller(BookController::class)
        ->prefix('book')
        ->name('book.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
    

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
                    Route::post('/destroy/{id}', 'destroy')->name('destroy');
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
