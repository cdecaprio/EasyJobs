<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\AlumneController;
use App\Http\Controllers\UsuariController;

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


Route::get('/clase', [UsuariController::class, 'index'])->name('clase.index');
Route::post('/clase', [UsuariController::class, 'save'])->name('clase.save');
Route::get('/clase/list', [UsuariController::class, 'list'])->name('clase.list');
Route::get('/editclase/{id}', [UsuariController::class, 'edit'])->name('editclase.edit');
Route::put('/editclase/{id}', [UsuariController::class, 'update'])->name('editclase.update');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/ofertalist', [OfferController::class, 'index'])->name('ofertalist.index');
    Route::post('/ofertalist', [OfferController::class, 'save'])->name('ofertalist.save');

    Route::get('/musiclistindex', [MusicController::class, 'index'])->name('musiclistindex.index');
    Route::post('/musiclistsave', [MusicController::class, 'save'])->name('musiclistsave.save');
    Route::get('/musiclist', [MusicController::class, 'list'])->name('musiclist.list');
    Route::get('/musicrandom', [MusicController::class, 'random'])->name('musicrandom.random'); 
    Route::post('/musiclist/{id}', [MusicController::class, 'delete'])->name('musiclist.delete');
    Route::get('/musiclistview', [MusicController::class, 'view'])->name('musiclist.view');
    Route::get('/musiclistedit/{id}', [MusicController::class, 'edit'])->name('musiclist.edit');
   Route::get('/musicedit/{id}', [MusicController::class, 'edit'])->name('musicedit.edit');
   Route::put('/musicedit/{id}', [MusicController::class, 'update'])->name('musicedit.update');
});

require __DIR__.'/auth.php';
