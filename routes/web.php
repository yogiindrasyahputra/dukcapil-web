<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitizenServiceController;

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

Route::get('/', [CitizenServiceController::class, 'index'])->name('home');
Route::get('/layanan/{slug}', [CitizenServiceController::class, 'show'])->name('services.show');
Route::post('/layanan/{slug}/ajukan', [CitizenServiceController::class, 'store'])
    ->middleware('throttle:10,1')
    ->name('services.store');
Route::get('/lacak/{code}', [CitizenServiceController::class, 'track'])
    ->middleware('throttle:30,1')
    ->name('applications.track');
Route::get('/lacak/{code}/status', [CitizenServiceController::class, 'trackStatus'])
    ->middleware('throttle:30,1')
    ->name('applications.track.status');
