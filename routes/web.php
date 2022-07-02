<?php

use App\Http\Controllers\PatientsController;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\TreatmentController;

use App\Http\Controllers\StadisticsController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AppointmentRequestController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('usuarios', UserInfoController::class)->middleware(['role:1', 'auth:sanctum']);
Route::resource('pacientes', PatientsController::class)->middleware(['role:1', 'auth:sanctum']);
Route::resource('tratamientos', TreatmentController::class)->middleware(['role:1', 'auth:sanctum']);
Route::resource('estadisticas', StadisticsController::class)->middleware(['role:1','auth:sanctum']);
Route::get('calculadora',  [PageController::class, 'calculator'])->middleware(['role:1','auth:sanctum'])->name('calculadora');
Route::resource('solicitudes', AppointmentRequestController::class)->middleware(['auth:sanctum']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


