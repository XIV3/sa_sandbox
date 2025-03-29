<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/sites', [AdminController::class, 'sites'])->name('admin.sites');
    Route::get('/servers', [AdminController::class, 'servers'])->name('admin.servers');
    // Settings routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
    Route::post('/settings/test-email', [SettingsController::class, 'testEmail'])->name('admin.settings.test-email');
    Route::post('/settings/test-serveravatar-api', [SettingsController::class, 'testServerAvatarApi'])->name('admin.settings.test-serveravatar-api');
    Route::post('/settings/test-cloudflare-api', [SettingsController::class, 'testCloudflareApi'])->name('admin.settings.test-cloudflare-api');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
