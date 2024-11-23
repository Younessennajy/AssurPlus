<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DataController;
use App\Http\Controllers\User\ImportController;
use App\Http\Controllers\User\ExportsController;
use App\Http\Controllers\User\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    
        Route::get('/data/pays', [DataController::class, 'pays'])->name('data.pays');

        Route::get('/pays/{pays}/b2b', [DataController::class, 'showB2BData'])->name('pays.b2b');
        Route::get('/pays/{pays}/b2c', [DataController::class, 'showB2CData'])->name('pays.b2c');

        Route::get('/import', [ImportController::class, 'showMappingForm'])->name('import.show');
        Route::match(['get', 'post'], 'import/read-headers/{pays}/{type}', [ImportController::class, 'readExcelHeaders'])
        ->name('import.readHeaders');
        Route::post('/import/process', [ImportController::class, 'processImport'])->name('import.process');
        Route::get('/import/columns/{type}', [ImportController::class, 'getColumnsByType'])->name('import.columns');


        Route::post('/export/{pays}/{type}', [ExportsController::class, 'export'])
    ->name('export');
        // Route::post('/import/confirm', [ImportController::class, 'confirmImport'])->name('import.confirm');
        // Route::get('/import/cancel', [ImportController::class, 'cancelImport'])->name('import.cancel');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin-auth.php';
