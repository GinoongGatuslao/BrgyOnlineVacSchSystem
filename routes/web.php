<?php

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

Route::get('/', App\Http\Livewire\Dashboard::class)->middleware(['auth'])->name('dashboard-home');

Route::get('/dashboard/80a751fde{dateSelected}5770286{adp_id}40c419000e33eba6',App\Http\Livewire\Dashboard::class)->middleware(['auth'])->name('dashboard');

Route::get('/schedule/vaccination', App\Http\Livewire\Client\Dashboard\ScheduleVaccination::class)->middleware(['auth'])->name('schedule-vaccination');

require __DIR__ . '/auth.php';
