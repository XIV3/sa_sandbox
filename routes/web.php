<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ServerManagementController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Site creation from homepage
Route::post('/', [App\Http\Controllers\SiteController::class, 'store'])->name('home.sites.store');

// Public site details route
Route::get('/s/{uuid}', [SiteController::class, 'publicShow'])->name('sites.public.show');

// Legal pages
Route::view('/terms', 'legal.terms')->name('legal.terms');
Route::view('/privacy', 'legal.privacy')->name('legal.privacy');
Route::view('/disclaimer', 'legal.disclaimer')->name('legal.disclaimer');

// Debug route for form submission testing
if (config('app.debug')) {
    Route::post('/debug-form', function (\Illuminate\Http\Request $request) {
        \Illuminate\Support\Facades\Log::debug('Debug form submission', [
            'request' => $request->all(),
            'ip' => $request->ip(),
            'method' => $request->method(),
            'url' => $request->url()
        ]);
        return response()->json(['success' => true, 'data' => $request->all()]);
    })->name('debug.form');
}

// Admin Routes
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/sites', [SiteController::class, 'index'])->name('admin.sites.index');
    // Custom routes for sites to use UUID for viewing
    Route::get('/sites/create', [SiteController::class, 'create'])->name('admin.sites.create');
    Route::post('/sites', [SiteController::class, 'store'])->name('admin.sites.store');
    Route::get('/sites/{uuid}', [SiteController::class, 'show'])->name('admin.sites.show');
    Route::post('/sites/{site}/toggle-public', [SiteController::class, 'togglePublic'])->name('admin.sites.toggle-public');
    Route::delete('/sites/{site}', [SiteController::class, 'destroy'])->name('admin.sites.destroy');
    Route::get('/servers', [AdminController::class, 'servers'])->name('admin.servers');
    
    // Server Management Routes
    Route::prefix('server-management')->name('admin.server-management.')->group(function () {
        Route::get('/selected-servers', [ServerManagementController::class, 'getSelectedServers'])->name('get-selected');
        Route::post('/add-server', [ServerManagementController::class, 'addServer'])->name('add');
        Route::post('/remove-server', [ServerManagementController::class, 'removeServer'])->name('remove');
    });
    
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
