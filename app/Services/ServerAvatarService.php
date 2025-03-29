<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ServerAvatarService
{
    protected $apiUrl;
    protected $apiKey;
    protected $organizationId;
    protected $isConfigured = false;

    public function __construct()
    {
        $this->loadSettings();
    }

    /**
     * Load the ServerAvatar API settings from the database
     */
    private function loadSettings()
    {
        $settings = SystemSetting::whereIn('meta_key', [
            'api_url', 'api_key', 'organisation_id'
        ])->pluck('meta_value', 'meta_key')->toArray();

        $this->apiUrl = $settings['api_url'] ?? null;
        $this->apiKey = $settings['api_key'] ?? null;
        $this->organizationId = $settings['organisation_id'] ?? null;

        // Check if all settings are available
        $this->isConfigured = !empty($this->apiUrl) && !empty($this->apiKey) && !empty($this->organizationId);
    }

    /**
     * Check if the service is configured
     */
    public function isConfigured(): bool
    {
        return $this->isConfigured;
    }

    /**
     * Get all servers from the ServerAvatar API
     * 
     * @param int $page Page number for pagination
     * @return array
     */
    public function getServers($page = 1)
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => []
            ];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey
            ])->get($this->apiUrl . '/organizations/' . $this->organizationId . '/servers', [
                'pagination' => 1,
                'page' => $page
            ]);

            if ($response->successful() && isset($response->json()['servers'])) {
                return [
                    'success' => true,
                    'data' => $response->json()['servers'],
                    'message' => 'Servers retrieved successfully'
                ];
            } else {
                // Handle API error response
                $errorMessage = 'Failed to retrieve servers. ';
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Organization not found. Please check your Organization ID.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($response->json()['message'])) {
                        $errorMessage .= ' - ' . $response->json()['message'];
                    }
                }

                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => []
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => []
            ];
        }
    }

    /**
     * Get a specific server's details
     */
    public function getServer($serverId)
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey
            ])->get($this->apiUrl . '/organizations/' . $this->organizationId . '/servers/' . $serverId);

            if ($response->successful() && isset($response->json()['server'])) {
                return [
                    'success' => true,
                    'data' => $response->json()['server'],
                    'message' => 'Server details retrieved successfully'
                ];
            } else {
                // Handle API error response
                $errorMessage = 'Failed to retrieve server details. ';
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Server not found.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($response->json()['message'])) {
                        $errorMessage .= ' - ' . $response->json()['message'];
                    }
                }
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => null
                ];
            }
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }
}