<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SelectedServer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'server_id',
        'name',
        'ip_address',
        'web_server',
        'database_type',
        'cores',
        'connection_status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Create or update a server from API data
     *
     * @param array $serverData
     * @return SelectedServer
     */
    public static function createFromApiData(array $serverData)
    {
        // Determine connection status based on both agent_status and ssh_status
        $isAgentConnected = isset($serverData['agent_status']) && $serverData['agent_status'] == '1';
        $isSshConnected = isset($serverData['ssh_status']) && $serverData['ssh_status'] == '1';
        
        // Only set to connected if both agent and SSH are connected
        $connectionStatus = ($isAgentConnected && $isSshConnected) ? 'connected' : 'disconnected';

        // Create or update the server record with essential information including connection status
        return self::updateOrCreate(
            ['server_id' => $serverData['id']],
            [
                'name' => $serverData['name'],
                'ip_address' => $serverData['ip'] ?? '',
                'web_server' => $serverData['web_server'] ?? null,
                'database_type' => $serverData['database_type'] ?? null,
                'cores' => isset($serverData['cores']) && is_numeric($serverData['cores']) ? $serverData['cores'] : null,
                'connection_status' => $connectionStatus,
            ]
        );
    }
    
    /**
     * Get the sites that belong to this server.
     *
     * @return HasMany
     */
    public function sites(): HasMany
    {
        return $this->hasMany(Site::class, 'selected_server_id');
    }
}
