<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkripsiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/skripsi', [SkripsiController::class, 'index'])->name('skripsi.index');
    Route::get('/skripsi/create', [SkripsiController::class, 'create'])->name('skripsi.create');
    Route::post('/skripsi', [SkripsiController::class, 'store'])->name('skripsi.store');
    Route::get('/skripsi/{skripsi}', [SkripsiController::class, 'show'])->name('skripsi.show');
});
// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
//     Route::resource('thesis', 'ThesisController');
//     Route::resource('schedule', 'ScheduleController');
//     Route::resource('documents', 'DocumentController');
//     // ... other routes
// });

require __DIR__.'/auth.php';
