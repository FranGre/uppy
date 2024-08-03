<?php

use App\Http\Controllers\DeleteImageController;
use App\Http\Controllers\UploadImageController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::post('/upload/image', UploadImageController::class)->name('uploadImage');
Route::delete('/delete/image', DeleteImageController::class)->name('deleteImage');

require __DIR__ . '/auth.php';
