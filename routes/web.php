<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExpenseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // ✅ Dashboard uses ExpenseController
    Route::get('/dashboard', [ExpenseController::class, 'dashboard'])
        ->name('dashboard');

    Route::get('/expenses', [ExpenseController::class, 'index'])
        ->name('index');

    // ✅ Expense CRUD (only once)
    Route::resource('expenses', ExpenseController::class);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
