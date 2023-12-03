<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicRouteController;
use App\Http\Controllers\SettingController;
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

Route::get('/', [PublicRouteController::class, 'index'])->name('app.index');
Route::get('/about', [PublicRouteController::class, 'about'])->name('app.about');
Route::get('/terms', [PublicRouteController::class, 'terms'])->name('app.terms');
Route::get('/healthz', [PublicRouteController::class, 'healthz'])->name('app.healthz');
Route::get('/privacy', [PublicRouteController::class, 'privacy'])->name('app.privacy');
Route::get('/contact', [PublicRouteController::class, 'contact'])->name('app.contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/events', [EventController::class, 'index'])->name('events');
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
