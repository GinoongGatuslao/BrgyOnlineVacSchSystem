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
Route::get('notif-sender',function(){
   $message = request('message');
   event(new App\Events\sendnotifications($message));
});

Route::get('/', App\Http\Livewire\Dashboard::class)->middleware(['auth'])->name('home');
Route::get('/dashboard_home', App\Http\Livewire\Dashboard::class)->middleware(['auth'])->name('dashboard-home');

Route::get('/dashboard/80a751fde{dateSelected}5770286{adp_id}40c419000e33eba6',App\Http\Livewire\Dashboard::class)->middleware(['auth'])->name('dashboard');
Route::get('/dashboard/schedule/{dateSelected}/{adp_id}',App\Http\Livewire\Dashboard::class)->middleware(['auth'])->name('view-schedule');
Route::get('/dash/schedule/patient/5770286{patient_id}40c41900',App\Http\Livewire\Admin\Dashboard\ViewPatientInformation::class)->middleware(['auth'])->name('view-patient-information');
Route::get('/ratings',App\Http\Livewire\Admin\Pages\Ratings::class)->middleware(['auth'])->name('ratings');
Route::get('/schedule/vaccination', App\Http\Livewire\Client\Dashboard\ScheduleVaccination::class)->middleware(['auth'])->name('schedule-vaccination');

Route::get('/manage-profile', App\Http\Livewire\Pages\EditProfile::class)->middleware(['auth'])->name('edit-profile');
Route::get('/manage-vaccines', App\Http\Livewire\Admin\Pages\ManageVaccines::class)->middleware(['auth'])->name('manage-vaccines');
Route::get('/vaccine-reports', App\Http\Livewire\Admin\Pages\VaccineReports::class)->middleware(['auth'])->name('vaccine-reports');

require __DIR__ . '/auth.php';
