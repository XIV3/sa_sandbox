<?php

namespace App\Http\Controllers;

use App\Models\SelectedServer;
use App\Services\ServerAvatarService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServerManagementController extends Controller
{
    protected $serverAvatarService;

    public function __construct(ServerAvatarService $serverAvatarService)
    {
        $this->serverAvatarService = $serverAvatarService;
    }

    public function getSelectedServers(): JsonResponse
    {
        $servers = SelectedServer::all();
        
        return response()->json([
            'success' => true,
            'data' => $servers
        ]);
    }

    public function addServer(Request $request): JsonResponse
    {
        $request->validate([
            'server_id' => 'required|integer'
        ]);

        $serverId = $request->input('server_id');
        
        $existingServer = SelectedServer::where('server_id', $serverId)->first();
        if ($existingServer) {
            return response()->json([
                'success' => false,
                'message' => 'Server already added to selected servers'
            ]);
        }
        
        $result = $this->serverAvatarService->getServer($serverId);
        
        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => $result['message']
            ]);
        }
        
        try {
            $serverData = $result['data'];
            
            $isAgentConnected = isset($serverData['agent_status']) && $serverData['agent_status'] == '1';
            $isSshConnected = isset($serverData['ssh_status']) && $serverData['ssh_status'] == '1';
            
            $connectionStatus = ($isAgentConnected && $isSshConnected) ? 'connected' : 'disconnected';
            
            $server = new SelectedServer();
            $server->server_id = $serverData['id'];
            $server->name = $serverData['name'];
            $server->ip_address = $serverData['ip'] ?? '';
            $server->web_server = $serverData['web_server'] ?? null;
            $server->database_type = $serverData['database_type'] ?? null;
            $server->cores = isset($serverData['cores']) && is_numeric($serverData['cores']) ? $serverData['cores'] : null;
            $server->connection_status = $connectionStatus;
            
            $exists = SelectedServer::where('server_id', $serverData['id'])->first();
            if ($exists) {
                $exists->delete();
            }
            
            $server->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Server added successfully',
                'data' => $server
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add server: ' . $e->getMessage()
            ]);
        }
    }

    public function removeServer(Request $request): JsonResponse
    {
        $request->validate([
            'server_id' => 'required|integer'
        ]);

        $serverId = $request->input('server_id');
        
        $server = SelectedServer::where('server_id', $serverId)->first();
        
        if (!$server) {
            return response()->json([
                'success' => false,
                'message' => 'Server not found in selected servers'
            ]);
        }
        
        try {
            $server->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Server removed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to remove server: ' . $e->getMessage()
            ]);
        }
    }
    
    /**
     * Update the phpMyAdmin URL for a server
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updatePhpMyAdminUrl(Request $request): JsonResponse
    {
        $request->validate([
            'server_id' => 'required|integer',
            'phpmyadmin_url' => 'nullable|url'
        ]);

        $serverId = $request->input('server_id');
        $phpmyadminUrl = $request->input('phpmyadmin_url');
        
        $server = SelectedServer::where('server_id', $serverId)->first();
        
        if (!$server) {
            return response()->json([
                'success' => false,
                'message' => 'Server not found in selected servers'
            ]);
        }
        
        try {
            $server->phpmyadmin_url = $phpmyadminUrl;
            $server->save();
            
            return response()->json([
                'success' => true,
                'message' => 'phpMyAdmin URL updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update phpMyAdmin URL: ' . $e->getMessage()
            ]);
        }
    }
}
