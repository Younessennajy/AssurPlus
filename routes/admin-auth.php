<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\ExportsController;
use App\Http\Controllers\ImportController;

Route::middleware('guest:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:admin')->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->middleware(['verified'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/update-permission', [UserController::class, 'updatePermissions'])
    ->name('users.updatePermission');


        Route::get('/data/pays', [DataController::class, 'pays'])->name('data.pays');

        Route::get('/pays/{pays}/b2b', [DataController::class, 'showB2BData'])->name('pays.b2b');
        Route::get('pays/{pays}/b2c', [DataController::class, 'showB2CData'])->name('pays.b2c');

        Route::get('/import', [ImportController::class, 'showMappingForm'])->name('import.show');
        Route::match(['get', 'post'], 'admin/import/read-headers/{pays}/{type}', [ImportController::class, 'readExcelHeaders'])
        ->name('import.readHeaders');
        Route::post('/import/process', [ImportController::class, 'processImport'])->name('import.process');
        Route::get('/import/columns/{type}', [ImportController::class, 'getColumnsByType'])->name('import.columns');

        Route::post('/admin/import/confirm', [ImportController::class, 'confirmImport'])->name('admin.import.confirm');
        Route::get('/admin/import/cancel', [ImportController::class, 'cancelImport'])->name('admin.import.cancel');


/* edit b2b */
    Route::delete('/data/{pays}/{type}/{id}/delete', [DataController::class, 'deleteData'])->name('data.delete');
    Route::get('/data/{pays}/{type}/{id}/edit', [DataController::class, 'showEditForm'])->name('data.edit');
    Route::post('/data/{pays}/{type}/{id}/update', [DataController::class, 'updateData'])->name('data.update');

    /* export */
    Route::post('/export/{pays}/{type}', [ExportsController::class, 'export'])
    ->name('export');


    Route::get('/import-history', [ImportController::class, 'history'])->name('import.history');
});