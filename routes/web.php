<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [AppController::class, 'index'])->name('app.index');
Route::get('/about', [AppController::class, 'about'])->name('app.about');
Route::get('/terms', [AppController::class, 'terms'])->name('app.terms');
Route::get('/healthz', [AppController::class, 'healthz'])->name('app.healthz');
Route::get('/privacy', [AppController::class, 'privacy'])->name('app.privacy');
Route::get('/contact', [AppController::class, 'contact'])->name('app.contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
