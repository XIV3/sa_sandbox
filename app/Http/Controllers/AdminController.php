<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function sites()
    {
        return view('admin.sites');
    }

    public function servers()
    {
        return view('admin.servers');
    }

    // Settings now handled by SettingsController
}