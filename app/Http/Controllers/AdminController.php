<?php

namespace App\Http\Controllers;

use App\Services\ServerAvatarService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $serverAvatarService;

    public function __construct(ServerAvatarService $serverAvatarService)
    {
        $this->serverAvatarService = $serverAvatarService;
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function sites()
    {
        return view('admin.sites');
    }

    public function servers(Request $request)
    {
        $page = $request->input('page', 1);
        $result = $this->serverAvatarService->getServers($page);
        
        $servers = [];
        $pagination = null;
        $apiConfigured = $this->serverAvatarService->isConfigured();
        $errorMessage = null;
        
        if ($result['success']) {
            $apiResponse = $result['data'];
            $servers = $apiResponse['data'] ?? [];
            
            // Extract pagination info
            if (isset($apiResponse['current_page'])) {
                $pagination = [
                    'current_page' => $apiResponse['current_page'],
                    'from' => $apiResponse['from'],
                    'to' => $apiResponse['to'],
                    'total' => $apiResponse['total'],
                    'last_page' => $apiResponse['last_page'],
                    'per_page' => $apiResponse['per_page'],
                    'prev_page_url' => $apiResponse['prev_page_url'],
                    'next_page_url' => $apiResponse['next_page_url'],
                ];
            }
        } else {
            $errorMessage = $result['message'];
        }
        
        return view('admin.servers', compact('servers', 'pagination', 'apiConfigured', 'errorMessage'));
    }

    // Settings now handled by SettingsController
}