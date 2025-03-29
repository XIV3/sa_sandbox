<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Route to handle WordPress site creation form submission
// This is a placeholder that will be implemented later
Route::post('/create-site', function (Request $request) {
    // Validate the input
    $rules = [
        'subdomain' => 'required|string|alpha_dash|min:3|max:30',
        'terms' => 'required|accepted',
    ];
    
    // Only validate email if the send_email checkbox is selected
    if ($request->has('send_email')) {
        $rules['email'] = 'required|email';
    }
    
    $validated = $request->validate($rules);
    
    // Here we'll implement the actual site creation logic later
    // using the ServerAvatar API for WordPress auto-installation
    
    // For now, just return a success message
    $successMessage = 'Your throwaway WordPress site is being created!';
    
    if ($request->has('send_email')) {
        $successMessage .= ' Check your email for login details and we\'ll remind you before deletion.';
    } else {
        $successMessage .= ' Your site will be available shortly and auto-deleted in 24 hours.';
    }
    
    return back()->with('success', $successMessage);
})->name('create-site');
