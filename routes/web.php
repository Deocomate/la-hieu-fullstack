<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\EventPhotoController;
use App\Http\Controllers\Client\FacesAndPlacesController;
use App\Http\Controllers\Client\PhotojournalismController;
use App\Http\Controllers\Client\VideographyController;

/*
|--------------------------------------------------------------------------
| DYNAMIC FRONTEND ROUTES ĐÃ BỊ LOẠI BỎ
| Sử dụng Explicit Routing để tối ưu tốc độ và bảo mật.
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Event Photos
Route::prefix('event-photos')->name('event-photos.')->group(function () {
    Route::get('/', [EventPhotoController::class, 'index'])->name('index');
    Route::get('/{slug}', [EventPhotoController::class, 'show'])->name('show');
});

// Faces & Places
Route::prefix('faces-and-places')->name('faces-and-places.')->group(function () {
    Route::get('/', [FacesAndPlacesController::class, 'index'])->name('index');
    Route::get('/{slug}', [FacesAndPlacesController::class, 'show'])->name('show');
});

// Photojournalism
Route::prefix('photojournalism')->name('photojournalism.')->group(function () {
    Route::get('/', [PhotojournalismController::class, 'index'])->name('index');
    Route::get('/{slug}', [PhotojournalismController::class, 'show'])->name('show');
});

// Videography
Route::prefix('videography')->name('videography.')->group(function () {
    Route::get('/', [VideographyController::class, 'index'])->name('index');
    Route::get('/{slug}', [VideographyController::class, 'show'])->name('show');
});