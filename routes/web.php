<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\MusicController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'isAuthenticated' => Auth::check(),
    ]);
})->name('Welcome');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/ofertalist', [OfferController::class, 'index'])->name('ofertalist.index');
    Route::post('/ofertalist', [OfferController::class, 'save'])->name('ofertalist.save');
    Route::get('/musicform', [MusicController::class, 'index'])->name('musicform.index');
    Route::post('/musicform', [MusicController::class, 'save'])->name('musicform.save');
    Route::get('/musiclist', [MusicController::class, 'list'])->name('musiclist.list');
});

require __DIR__.'/auth.php';
