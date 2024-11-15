<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth'])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Routes pour l'import
    Route::get('/import', [ImportController::class, 'show'])
        ->name('import.show')
        ->middleware('can:import');

    // Routes pour l'export
    Route::get('/export', [ExportController::class, 'show'])
        ->name('export.show')
        ->middleware('can:export');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
