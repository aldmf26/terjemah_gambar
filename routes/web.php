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
use App\Http\Controllers\UsersController;
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
    return view('welcome');
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
                    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
                });
                
            Route::controller(MembersController::class)
                ->prefix('members')
                ->name('members.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/destroy', 'destroy')->name('destroy');
                    Route::put('/update/{id}', 'update')->name('update');
                    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
                });
            Route::controller(BooksController::class)
                ->prefix('books')
                ->name('books.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/show', 'show')->name('show');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/destroy', 'destroy')->name('destroy');
                    Route::post('/store', 'store')->name('store');

                });
            Route::controller(CategoriesController::class)
                ->prefix('categories')
                ->name('categories.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/update', 'update')->name('update');
                    Route::delete('/destroy/{id}', 'destroy')->name('destroy');
                });
            Route::controller(RaksController::class)
                ->prefix('racks')
                ->name('racks.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                });
            Route::controller(LoansController::class)
                ->prefix('loans')
                ->name('loans.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::get('/search', 'search')->name('search');
                    Route::get('/list_print_request', 'list_print_request')->name('list_print_request');
                    Route::get('/print', 'print')->name('print');
                    Route::get('/print_approve/{id}', 'print_approve')->name('print_approve');
                    Route::get('/show/{id}', 'show')->name('show');
                    Route::post('/new', 'new')->name('new');
                    Route::post('/store', 'store')->name('store');
                    Route::post('/print_request', 'print_request')->name('print_request');
                });
            Route::controller(ReturnsController::class)
                ->prefix('returns')
                ->name('returns.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                });
            Route::controller(FineController::class)
                ->prefix('fines')
                ->name('fines.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                });
        });
});

require __DIR__ . '/auth.php';
