<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompaniesController;

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [CompaniesController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    //companies routes
    Route::get('/companies', [CompaniesController::class, 'index'])->name('companies.index');
    Route::get('/companies/create', [CompaniesController::class, 'create'])->name('companies.create');
    Route::post('/companies/store', [CompaniesController::class, 'store'])->name('companies.store');
    Route::get('/companies/show{id}', [CompaniesController::class, 'show'])->name('companies.show');
    Route::get('/companies/edit{id}', [CompaniesController::class, 'edit'])->name('companies.edit');
    Route::put('/companies/edit{id}', [CompaniesController::class, 'update'])->name('companies.update');
    Route::delete('/companies/destroy{id}', [CompaniesController::class, 'destroy'])->name('companies.destroy');
});

require __DIR__.'/auth.php';
