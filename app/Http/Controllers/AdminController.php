<?php

namespace App\Http\Controllers;

use App\Services\ServerAvatarService;
use App\Services\SystemSettingsService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $serverAvatarService;
    protected $systemSettings;

    public function __construct(ServerAvatarService $serverAvatarService, SystemSettingsService $systemSettings)
    {
        $this->serverAvatarService = $serverAvatarService;
        $this->systemSettings = $systemSettings;
    }

    public function dashboard()
    {
        $domain = $this->systemSettings->getDomain();
        return view('admin.dashboard', compact('domain'));
    }

    // Sites functionality moved to SiteController

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
            
            // Cache the servers in the session for use in other controllers
            session(['available_servers' => $servers]);
            
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
        
        // Get selected servers
        $selectedServers = \App\Models\SelectedServer::all();
        
        return view('admin.servers', compact('servers', 'selectedServers', 'pagination', 'apiConfigured', 'errorMessage'));
    }

    // Settings now handled by SettingsController
}