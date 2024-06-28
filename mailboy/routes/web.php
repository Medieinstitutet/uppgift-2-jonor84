<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->check()) {
            return redirect('/');
        }

        $roles = auth()->user()->roles->pluck('name')->toArray();

        if (count(array_intersect($roles, ['admin', 'client', 'subscriber'])) > 0) {
            return view("{$roles[0]}.dashboard");
        } else {
            return view('dashboarderror');
        }

    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
