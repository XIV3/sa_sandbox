<?php

namespace App\Console\Commands;

use App\Models\SelectedServer;
use App\Services\ServerAvatarService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RefreshServerStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'servers:refresh-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the connection status of all selected servers';

    protected $serverAvatarService;

    public function __construct(ServerAvatarService $serverAvatarService)
    {
        parent::__construct();
        $this->serverAvatarService = $serverAvatarService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Refreshing server connection status...');
        
        // Check if the API is configured
        if (!$this->serverAvatarService->isConfigured()) {
            $this->error('ServerAvatar API is not configured. Please check your settings.');
            return 1;
        }
        
        // Get all selected servers
        $servers = SelectedServer::all();
        
        if ($servers->isEmpty()) {
            $this->info('No servers found in the database.');
            return 0;
        }
        
        $this->info('Found ' . $servers->count() . ' servers in the database.');
        
        $updatedCount = 0;
        $errorCount = 0;
        
        // Iterate over each server and check its status
        foreach ($servers as $server) {
            $this->info("Checking status for server: {$server->name} (ID: {$server->server_id})");
            
            try {
                // Fetch the latest server information from ServerAvatar API
                $result = $this->serverAvatarService->getServer($server->server_id);
                
                if (!$result['success']) {
                    $this->error("Failed to fetch server info: {$result['message']}");
                    $errorCount++;
                    Log::warning('Failed to refresh server status', [
                        'server_id' => $server->server_id,
                        'error' => $result['message']
                    ]);
                    continue;
                }
                
                $serverData = $result['data'];
                
                // Determine connection status based on both agent_status and ssh_status
                $isAgentConnected = isset($serverData['agent_status']) && $serverData['agent_status'] == '1';
                $isSshConnected = isset($serverData['ssh_status']) && $serverData['ssh_status'] == '1';
                
                // Only set to connected if both agent and SSH are connected
                $newConnectionStatus = ($isAgentConnected && $isSshConnected) ? 'connected' : 'disconnected';
                
                // Update the server record with the new status
                $oldStatus = $server->connection_status;
                $server->connection_status = $newConnectionStatus;
                $server->save();
                
                if ($oldStatus !== $newConnectionStatus) {
                    $this->info("Updated server status from '{$oldStatus}' to '{$newConnectionStatus}'");
                    
                    Log::info('Server connection status updated', [
                        'server_id' => $server->server_id,
                        'server_name' => $server->name,
                        'old_status' => $oldStatus,
                        'new_status' => $newConnectionStatus,
                        'agent_connected' => $isAgentConnected,
                        'ssh_connected' => $isSshConnected
                    ]);
                    
                    $updatedCount++;
                } else {
                    $this->line("Server status unchanged: '{$newConnectionStatus}'");
                }
                
            } catch (\Exception $e) {
                $this->error("Error refreshing server status: " . $e->getMessage());
                $errorCount++;
                Log::error('Exception while refreshing server status', [
                    'server_id' => $server->server_id,
                    'server_name' => $server->name,
                    'exception' => $e->getMessage()
                ]);
            }
        }
        
        $this->info("Server status refresh completed:");
        $this->info("- Total servers: " . $servers->count());
        $this->info("- Statuses updated: " . $updatedCount);
        $this->info("- Errors encountered: " . $errorCount);
        
        return 0;
    }
}