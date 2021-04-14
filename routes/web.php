<?php

use App\Http\Controllers\BookingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\EventController;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [EventController::class, "index"])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->resource('event', EventController::class)->only([
    'show', 'edit', 'create', 'destroy', "store", "update"
]);
Route::middleware(['auth:sanctum', 'verified'])->get("/myevents", [EventController::class, "mine"])->name("myevents");

Route::middleware(['auth:sanctum', 'verified'])->resource('booking', BookingController::class)->only(['store', 'destroy', 'index']);
