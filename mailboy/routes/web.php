<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\NewsletterController;

// Public routes
Route::get('/', [PublicController::class, 'dashboard'])->name('public.dashboard');
Route::get('/allnewsletters', [PublicController::class, 'allnewsletters'])->name('public.allnewsletters');

// Authenticated routes
Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', function () {
        if (!auth()->check()) {
            return redirect('/');
        }

        $roles = auth()->user()->roles->pluck('name')->toArray();

        if (count(array_intersect($roles, ['admin', 'client', 'subscriber'])) > 0) {
            return view("{$roles[0]}.dashboard");
        } else {
            return view('dashboard');
        }
    })->name('dashboard');

    // Admin routes
    Route::middleware('auth')->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    // Client routes
    Route::middleware('auth')->group(function () {
        Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
        Route::get('/client/mynewsletters', [ClientController::class, 'mynewsletters'])->name('client.mynewsletters');
        Route::post('/client/mynewsletters', [ClientController::class, 'storeNewsletter'])->name('client.store-newsletter');
        Route::get('/client/mynewsletters/create', [ClientController::class, 'createNewsletter'])->name('client.create-newsletter');
        Route::get('/client/mynewsletters/{id}/edit', [ClientController::class, 'editNewsletter'])->name('client.edit-newsletter');
        Route::put('/client/mynewsletters/{id}', [ClientController::class, 'updateNewsletter'])->name('client.update-newsletter');
        Route::delete('/client/mynewsletters/{id}', [ClientController::class, 'destroyNewsletter'])->name('client.destroy-newsletter');
        Route::get('/client/mysubscribers/{newsletterId}', [ClientController::class, 'mysubscribers'])->name('client.mysubscribers');

    });

    // Subscriber routes
    Route::middleware('auth')->group(function () {
        Route::get('/subscriber/dashboard', [SubscriberController::class, 'dashboard'])->name('subscriber.dashboard');
        Route::get('/subscriber/allnewsletters', [SubscriberController::class, 'showActiveNewsletters'])->name('subscriber.allnewsletters');
        Route::post('/subscriber/subscribe/{newsletterId}', [SubscriberController::class, 'subscribe'])->name('subscribe.newsletter');
        Route::delete('/subscriber/unsubscribe/{newsletterId}', [SubscriberController::class, 'unsubscribe'])->name('unsubscribe.newsletter');
        Route::get('/subscriber/mysubscriptions', [SubscriberController::class, 'mysubscriptions'])->name('subscriber.mysubscriptions');
    });

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
