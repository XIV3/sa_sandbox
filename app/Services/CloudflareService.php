<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CloudflareService
{
    protected $apiUrl = 'https://api.cloudflare.com/client/v4';
    protected $apiKey;
    protected $zoneId;
    protected $domain;
    protected $isConfigured = false;

    public function __construct()
    {
        $this->loadSettings();
    }

    /**
     * Load the Cloudflare API settings from the database
     */
    private function loadSettings()
    {
        $settings = SystemSetting::whereIn('meta_key', [
            'cloudflare_api_key', 'zone_id', 'domain'
        ])->pluck('meta_value', 'meta_key')->toArray();

        $this->apiKey = $settings['cloudflare_api_key'] ?? null;
        $this->zoneId = $settings['zone_id'] ?? null;
        $this->domain = $settings['domain'] ?? null;

        // Check if all settings are available
        $this->isConfigured = !empty($this->apiKey) && !empty($this->zoneId) && !empty($this->domain);
    }

    /**
     * Check if the service is configured
     */
    public function isConfigured(): bool
    {
        return $this->isConfigured;
    }

    /**
     * Create an A record in Cloudflare DNS
     * 
     * @param string $name Subdomain or hostname
     * @param string $ipAddress IP address for the A record
     * @param bool $proxied Whether to proxy through Cloudflare
     * @param int $ttl TTL value (1 for automatic)
     * @return array Response with success status, message, and data
     */
    public function createARecord(string $name, string $ipAddress, bool $proxied = true, int $ttl = 1): array
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'Cloudflare API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        // Ensure the name is properly formatted
        // If it's just the subdomain, append the domain
        if (strpos($name, '.') === false) {
            $name = $name . '.' . $this->domain;
        }

        try {
            $endpoint = "/zones/{$this->zoneId}/dns_records";
            
            // Log the request details for debugging
            Log::debug('Cloudflare API A Record Creation Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'name' => $name,
                'ip_address' => $ipAddress
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey
            ])->post($this->apiUrl . $endpoint, [
                'type' => 'A',
                'name' => $name,
                'content' => $ipAddress,
                'ttl' => $ttl,
                'proxied' => $proxied
            ]);
            
            // Log the response for debugging
            Log::debug('Cloudflare API A Record Creation Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json()
            ]);

            $responseData = $response->json();

            if ($response->successful() && isset($responseData['success']) && $responseData['success'] === true) {
                return [
                    'success' => true,
                    'message' => 'DNS A record created successfully',
                    'data' => $responseData['result'] ?? null,
                    'record_id' => $responseData['result']['id'] ?? null
                ];
            } else {
                $errorMessage = 'Failed to create DNS A record. ';
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Zone not found. Please check your Zone ID.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    
                    // Extract error messages from Cloudflare response
                    if (isset($responseData['errors']) && !empty($responseData['errors'])) {
                        foreach ($responseData['errors'] as $error) {
                            $errorMessage .= ' - ' . $error['message'];
                        }
                    }
                }
                
                Log::error('Cloudflare API Error: ' . $errorMessage, [
                    'response' => $responseData
                ]);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => $responseData
                ];
            }
        } catch (\Exception $e) {
            Log::error('Cloudflare API Exception: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            
            return [
                'success' => false,
                'message' => 'Failed to connect to Cloudflare API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Delete a DNS record in Cloudflare
     * 
     * @param string $recordId The ID of the DNS record to delete
     * @return array Response with success status, message, and data
     */
    public function deleteDnsRecord(string $recordId): array
    {
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'Cloudflare API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        try {
            $endpoint = "/zones/{$this->zoneId}/dns_records/{$recordId}";
            
            // Log the request details for debugging
            Log::debug('Cloudflare API DNS Record Deletion Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'record_id' => $recordId
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey
            ])->delete($this->apiUrl . $endpoint);
            
            // Log the response for debugging
            Log::debug('Cloudflare API DNS Record Deletion Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json()
            ]);

            $responseData = $response->json();

            if ($response->successful() && isset($responseData['success']) && $responseData['success'] === true) {
                return [
                    'success' => true,
                    'message' => 'DNS record deleted successfully',
                    'data' => $responseData['result'] ?? null
                ];
            } else {
                $errorMessage = 'Failed to delete DNS record. ';
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    // If record not found, consider it a success since it's already gone
                    return [
                        'success' => true,
                        'message' => 'DNS record not found or already deleted',
                        'data' => null
                    ];
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    
                    // Extract error messages from Cloudflare response
                    if (isset($responseData['errors']) && !empty($responseData['errors'])) {
                        foreach ($responseData['errors'] as $error) {
                            $errorMessage .= ' - ' . $error['message'];
                        }
                    }
                }
                
                Log::error('Cloudflare API Error: ' . $errorMessage, [
                    'response' => $responseData
                ]);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => $responseData
                ];
            }
        } catch (\Exception $e) {
            Log::error('Cloudflare API Exception: ' . $e->getMessage(), [
                'exception' => $e
            ]);
            
            return [
                'success' => false,
                'message' => 'Failed to connect to Cloudflare API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }
}