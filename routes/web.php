<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExpenseController;

Route::get('/', function () {
    return redirect()->route('expenses.index');
});

Route::resource('expenses', ExpenseController::class);
Route::get('/dashboard', [ExpenseController::class, 'dashboard'])
    ->name('expenses.dashboard');
