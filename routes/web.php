<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PortfolioController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Auth::routes(['verify' => true]);

Route::controller(FrontendController::class)->name('frontend.')->group(function () {

    Route::get('/', 'index')->name('index');
    Route::get('/', 'portfolio')->name('portfolio');
    /* Route::get('/', 'vehicle')->name('vehicle'); */
});

Route::middleware(['auth'])->group(
    function () {
        Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth', 'verified');

        Route::controller(CategoryController::class)->name('backend.category.')->group(function () {
            Route::get('/category', 'index')->name('index');
            Route::get('/category/create', 'create')->name('create');
            Route::post('/category/store', 'store')->name('store');
            Route::get('/category/edit/{category}', 'edit')->name('edit');
            Route::post('/category/update/{category}', 'update')->name('update');
            Route::get('/category/destroy/{category}', 'destroy')->name('trash');
            Route::get('/category/status/{category}', 'status')->name('status');
            Route::get('/category/reStore/{id}', 'reStore')->name('reStore');
            Route::get('/category/permDelete/{id}', 'permDelete')->name('delete');
        });
        Route::controller(PortfolioController::class)->name('backend.portfolio.')->group(function () {
            Route::get('/portfolio', 'index')->name('index');
            Route::get('/portfolio/create', 'create')->name('create');
            Route::post('/portfolio/store', 'store')->name('store');
            Route::get('/portfolio/edit/{portfolio}', 'edit')->name('edit');
            Route::post('/portfolio/update/{portfolio}', 'update')->name('update');
            Route::get('/portfolio/destroy/{portfolio}', 'destroy')->name('trash');
            Route::get('/portfolio/status/{portfolio}', 'status')->name('status');
            Route::get('/portfolio/reStore/{id}', 'reStore')->name('reStore');
            Route::get('/portfolio/permDelete/{id}', 'permDelete')->name('delete');
        });
    }
);
