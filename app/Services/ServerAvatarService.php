<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ServerAvatarService
{
    protected $apiUrl;
    protected $apiKey;
    protected $organizationId;
    protected $isConfigured = false;
    protected $settingsLoaded = false;

    public function __construct()
    {
        // Don't load settings in constructor to avoid database access during deployment
    }

    /**
     * Load the ServerAvatar API settings from the database
     */
    private function loadSettings()
    {
        if ($this->settingsLoaded) {
            return;
        }

        // Default values
        $this->apiUrl = 'https://api.serveravatar.com';
        $this->apiKey = null;
        $this->organizationId = null;
        $this->isConfigured = false;
        $this->settingsLoaded = true;

        // Skip during migrations
        if (getenv('APP_MIGRATING') === 'true') {
            return;
        }

        try {
            if (!Schema::hasTable('system_settings')) {
                return;
            }

            $settings = SystemSetting::whereIn('meta_key', [
                'api_url', 'api_key', 'organisation_id'
            ])->pluck('meta_value', 'meta_key')->toArray();

            $this->apiUrl = $settings['api_url'] ?? 'https://api.serveravatar.com';
            $this->apiKey = $settings['api_key'] ?? null;
            $this->organizationId = $settings['organisation_id'] ?? null;

            $this->isConfigured = !empty($this->apiUrl) && !empty($this->apiKey) && !empty($this->organizationId);
        } catch (\Exception $e) {
            // Silent fail
        }
    }

    /**
     * Check if the service is configured
     */
    public function isConfigured(): bool
    {
        $this->loadSettings();
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
        $this->loadSettings();
        
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
        $this->loadSettings();
        
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

    /**
     * Create a WordPress site on a server
     * 
     * @param string $serverId Server ID
     * @param string $hostname Domain name for the site
     * @return array Response with success status, message, and data
     */
    public function createWordPressSite(string $serverId, string $hostname): array
    {
        $this->loadSettings();
        
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        // Generate random username and password for WordPress admin (only letters and numbers)
        $wpUsername = 'admin' . Str::lower(Str::random(8)); // Removed underscore, alphanumeric only
        $wpPassword = Str::random(16);
        
        // Generate random username and password for system user (only letters and numbers)
        $systemUsername = 'user' . Str::lower(Str::random(8));  // Removed underscore, alphanumeric only
        $systemPassword = Str::random(16);
        
        // Generate random database name (alphanumeric only)
        $dbName = 'wp' . Str::lower(Str::random(10)); // Removed underscore to be safe

        // Simplify to ONLY the absolutely required parameters
        // Use safe values that are known to work with the API
        $data = [
            'name' => Str::lower(substr(preg_replace('/[^a-z0-9]/', '', $hostname), 0, 10)), // Keep it short and simple
            'method' => 'one_click',
            'framework' => 'wordpress',
            'temp_domain' => 0,
            'hostname' => $hostname,
            'systemUser' => 'new',
            'systemUserInfo' => [
                'username' => $systemUsername,
                'password' => $systemPassword
            ],
            'php_version' => '8.2', // String format per example
            'www' => 0,
            'email' => 'admin@' . $hostname, // Use proper domain instead of example.com
            'title' => 'WordPress Site',
            'username' => $wpUsername,
            'password' => $wpPassword,
            'install_litespeed_cache_plugin' => 0,
            'database_name' => $dbName
        ];

        try {
            $endpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/applications";
            
            // Log the request details for debugging
            Log::debug('ServerAvatar API WordPress Site Creation Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'organization_id' => $this->organizationId,
                'server_id' => $serverId,
                'request_data' => $data,
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json'
            ])->post($this->apiUrl . $endpoint, $data);
            
            // Log the response for debugging
            Log::debug('ServerAvatar API WordPress Site Creation Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json()
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                
                // Add credentials to response for later reference
                $responseData['credentials'] = [
                    'system_username' => $systemUsername,
                    'system_password' => $systemPassword,
                    'wp_username' => $wpUsername,
                    'wp_password' => $wpPassword,
                    'database_name' => $dbName
                ];
                
                return [
                    'success' => true,
                    'message' => $responseData['message'] ?? 'WordPress site created successfully',
                    'data' => $responseData
                ];
            } else {
                $errorMessage = 'Failed to create WordPress site. ';
                $errorData = $response->json();
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Server or organization not found.';
                } elseif ($response->status() === 422) {
                    // Special case for duplicate domain
                    if (isset($errorData['message']) && (
                        stripos($errorData['message'], 'duplicate domain') !== false ||
                        stripos($errorData['message'], 'domain name found') !== false
                    )) {
                        return [
                            'success' => false,
                            'message' => 'This domain name is already in use on the server. Please choose a different subdomain.',
                            'error_code' => 'duplicate_domain',
                            'data' => $errorData
                        ];
                    }
                    
                    $errorMessage .= 'Validation failed: ';
                    
                    // For 422 validation errors, include detailed validation messages
                    if (isset($errorData['errors']) && is_array($errorData['errors'])) {
                        foreach ($errorData['errors'] as $field => $messages) {
                            if (is_array($messages)) {
                                foreach ($messages as $message) {
                                    $errorMessage .= "$field: $message; ";
                                }
                            } else {
                                $errorMessage .= "$field: $messages; ";
                            }
                        }
                    } elseif (isset($errorData['message'])) {
                        $errorMessage .= $errorData['message'];
                    } else {
                        $errorMessage .= json_encode($errorData);
                    }
                } elseif ($response->status() === 500) {
                    // Handle server errors specifically
                    $errorMessage .= 'Server error occurred. ';
                    
                    // Check for specific WordPress installation errors
                    if (isset($errorData['message']) && 
                        (strpos($errorData['message'], 'installing WordPress') !== false ||
                         strpos($errorData['message'], 'WordPress installation') !== false)) {
                        return [
                            'success' => false,
                            'message' => 'The server encountered an error during WordPress installation. Please try again with a different subdomain or server.',
                            'error_code' => 'server_error',
                            'data' => $errorData
                        ];
                    }
                    
                    if (isset($errorData['message'])) {
                        $errorMessage .= $errorData['message'];
                    } else {
                        $errorMessage .= 'Unknown server error. Please try again later or contact support.';
                    }
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($errorData['message'])) {
                        $errorMessage .= ' - ' . $errorData['message'];
                    }
                }
                
                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => $errorData ?? null
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Delete an application from the server
     * 
     * @param string $serverId Server ID
     * @param string $applicationId Application ID
     * @return array Response with success status, message, and data
     */
    public function deleteApplication(string $serverId, string $applicationId): array
    {
        $this->loadSettings();
        
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not properly configured. Please check your settings.',
                'data' => null
            ];
        }

        try {
            $endpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/applications/{$applicationId}";
            
            // Log the request details for debugging
            Log::debug('ServerAvatar API Delete Application Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'organization_id' => $this->organizationId,
                'server_id' => $serverId,
                'application_id' => $applicationId
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json'
            ])->delete($this->apiUrl . $endpoint);
            
            // Log the response for debugging
            Log::debug('ServerAvatar API Delete Application Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json()
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => $response->json()['message'] ?? 'Application deleted successfully',
                    'data' => $response->json()
                ];
            } else {
                $errorMessage = 'Failed to delete application. ';
                $errorData = $response->json();
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Server, organization or application not found.';
                    // Consider this a "success" since the application doesn't exist anyway
                    return [
                        'success' => true,
                        'message' => 'Application not found or already deleted',
                        'data' => null
                    ];
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($errorData['message'])) {
                        $errorMessage .= ' - ' . $errorData['message'];
                    }
                }
                
                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => $errorData ?? null
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Install SSL certificate on an application
     * 
     * @param string $serverId Server ID
     * @param string $applicationId Application ID
     * @param bool $useCustom Whether to use custom SSL or automatic
     * @param bool $forceHttps Whether to force HTTPS redirect
     * @return array Response with success status, message, and data
     */
    public function installSSL(string $serverId, string $applicationId, bool $useCustom = false, bool $forceHttps = true): array
    {
        $this->loadSettings();
        
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        $data = [
            'ssl_type' => $useCustom ? 'custom' : 'automatic',
            'force_https' => $forceHttps ? 1 : 0 // Use 1/0 instead of true/false
        ];
        
        // Add custom SSL certificate data if applicable
        if ($useCustom) {
            // Use a more advanced method to retrieve the SSL certificate data with fallbacks
            // Define all possible key variations (in order of preference)
            $sslCertificateKeys = [
                'ssl_certificate', 
                'certificate', 
                'ssl_cert', 
                'cert', 
                'certificate_file', 
                'cert_file'
            ];
            $privateKeyKeys = [
                'private_key',
                'ssl_private_key', 
                'key', 
                'ssl_key', 
                'private_key_file',
                'key_file'
            ];
            $chainFileKeys = [
                'ssl_chain_file', 
                'chain_file', 
                'chain', 
                'ssl_chain',
                'certificate_chain',
                'ca_bundle'
            ];
            
            // Log what we're looking for
            Log::debug('Looking for SSL certificate and private key', [
                'possible_cert_keys' => $sslCertificateKeys,
                'possible_key_keys' => $privateKeyKeys,
                'possible_chain_keys' => $chainFileKeys
            ]);
            
            // Query all SSL settings at once to reduce database hits
            $allSslSettings = SystemSetting::whereIn('meta_key', 
                array_merge($sslCertificateKeys, $privateKeyKeys, $chainFileKeys)
            )->get();
            
            // Create lookup array for faster access
            $settingsMap = [];
            foreach ($allSslSettings as $setting) {
                $settingsMap[$setting->meta_key] = $setting;
            }
            
            Log::debug('Found SSL settings', [
                'count' => count($settingsMap),
                'keys' => array_keys($settingsMap)
            ]);
            
            // Find certificate using the map
            $sslCertificate = null;
            foreach ($sslCertificateKeys as $keyName) {
                if (isset($settingsMap[$keyName]) && !empty($settingsMap[$keyName]->meta_value)) {
                    $sslCertificate = $settingsMap[$keyName];
                    Log::debug("Found SSL certificate with key: {$keyName}");
                    break;
                }
            }
            
            // Find private key using the map
            $privateKey = null;
            foreach ($privateKeyKeys as $keyName) {
                if (isset($settingsMap[$keyName]) && !empty($settingsMap[$keyName]->meta_value)) {
                    $privateKey = $settingsMap[$keyName];
                    Log::debug("Found private key with key: {$keyName}");
                    break;
                }
            }
            
            // Find chain file using the map
            $chainFile = null;
            foreach ($chainFileKeys as $keyName) {
                if (isset($settingsMap[$keyName]) && !empty($settingsMap[$keyName]->meta_value)) {
                    $chainFile = $settingsMap[$keyName];
                    Log::debug("Found chain file with key: {$keyName}");
                    break;
                }
            }
            
            // If we couldn't find the certificate or private key, fallback to automatic SSL
            if (!$sslCertificate || !$privateKey) {
                Log::warning('Could not find SSL certificate or private key in system settings, falling back to automatic SSL', [
                    'certificate_found' => (bool)$sslCertificate,
                    'private_key_found' => (bool)$privateKey,
                    'available_keys' => array_keys($settingsMap)
                ]);
                
                // Change SSL type to automatic instead of failing
                $data['ssl_type'] = 'automatic';
                
                // Notify about the fallback but continue with the request
                Log::info('Falling back to automatic SSL certificate installation');
            } else {
                // Add certificate data to the request since we found both certificate and key
                $data['ssl_certificate'] = $sslCertificate->meta_value;
                $data['private_key'] = $privateKey->meta_value;
                
                if ($chainFile) {
                    $data['chain_file'] = $chainFile->meta_value;
                }
                
                // Log what we're using (don't log the actual certs/keys for security)
                Log::debug('Using SSL settings', [
                    'certificate_key' => $sslCertificate->meta_key,
                    'private_key_key' => $privateKey->meta_key,
                    'chain_file_key' => $chainFile ? $chainFile->meta_key : null,
                    'has_certificate' => strlen($sslCertificate->meta_value) > 0,
                    'has_private_key' => strlen($privateKey->meta_value) > 0,
                    'has_chain_file' => $chainFile ? strlen($chainFile->meta_value) > 0 : false
                ]);
            }
        }

        try {
            $endpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/applications/{$applicationId}/ssl";
            
            // Log the SSL installation request for debugging
            Log::debug('SSL Installation Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'server_id' => $serverId,
                'application_id' => $applicationId,
                'ssl_type' => $data['ssl_type'],
                'force_https' => $data['force_https'],
                'has_certificate' => isset($data['ssl_certificate']),
                'has_private_key' => isset($data['private_key']),
                'has_chain_file' => isset($data['chain_file'])
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json'
            ])->post($this->apiUrl . $endpoint, $data);
            
            // Log the response
            Log::debug('SSL Installation Response', [
                'status' => $response->status(),
                'success' => $response->successful(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => $response->json()['message'] ?? 'SSL certificate installed successfully',
                    'data' => $response->json()
                ];
            } else {
                $errorMessage = 'Failed to install SSL certificate. ';
                $errorData = $response->json();
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Server, organization or application not found.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($errorData['message'])) {
                        $errorMessage .= ' - ' . $errorData['message'];
                    }
                }
                
                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => $errorData ?? null
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Get application details including PHP information
     *
     * @param string $serverId Server ID
     * @param string $applicationId Application ID
     * @return array Response with success status, message, and data
     */
    public function getApplicationDetails(string $serverId, string $applicationId): array
    {
        $this->loadSettings();
        
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        try {
            $endpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/applications/{$applicationId}";
            
            // Log the request
            Log::debug('ServerAvatar API Get Application Details Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'organization_id' => $this->organizationId,
                'server_id' => $serverId,
                'application_id' => $applicationId
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json'
            ])->get($this->apiUrl . $endpoint);
            
            // Log the response status
            Log::debug('ServerAvatar API Get Application Details Response', [
                'status' => $response->status(),
                'success' => $response->successful()
            ]);

            if ($response->successful() && isset($response->json()['application'])) {
                $application = $response->json()['application'];
                
                // Log the keys available in the application object
                Log::debug('Application object keys', [
                    'keys' => array_keys($application)
                ]);
                
                // Extract PHP settings directly from the application object
                // Excluding PHP-FPM specific settings
                $phpSettings = [
                    'version' => $application['php_version'] ?? null,
                    'memory_limit' => $application['memory_limit'] ?? null,
                    'max_execution_time' => $application['max_execution_time'] ?? null,
                    'upload_max_filesize' => $application['upload_max_filesize'] ?? null,
                    'post_max_size' => $application['post_max_size'] ?? null,
                    'max_input_vars' => $application['max_input_vars'] ?? null,
                    'max_input_time' => $application['max_input_time'] ?? null
                ];
                
                return [
                    'success' => true,
                    'message' => 'Application details retrieved successfully',
                    'data' => [
                        'application' => $application,
                        'php_settings' => $phpSettings
                    ]
                ];
            } else {
                $errorMessage = 'Failed to retrieve application details. ';
                $errorData = $response->json();
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Application not found.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($errorData['message'])) {
                        $errorMessage .= ' - ' . $errorData['message'];
                    }
                }
                
                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => null
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Get database information for a WordPress site
     * 
     * @param string $serverId Server ID
     * @param string $applicationId Application ID
     * @param bool $fetchCredentials Whether to fetch database credentials (username/password)
     * @return array Response with success status, message, and data
     */
    public function getDatabaseInformation(string $serverId, string $applicationId, bool $fetchCredentials = false): array
    {
        $this->loadSettings();
        
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        try {
            $endpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/applications/{$applicationId}";
            
            // Log the request details for debugging
            Log::debug('ServerAvatar API Get Application Details Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'organization_id' => $this->organizationId,
                'server_id' => $serverId,
                'application_id' => $applicationId
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json'
            ])->get($this->apiUrl . $endpoint);
            
            // Log the response for debugging
            Log::debug('ServerAvatar API Get Application Details Response', [
                'status' => $response->status(),
                'success' => $response->successful(),
                // Log a sample of the response body (truncated for security)
                'response_body_sample' => substr($response->body(), 0, 500) . '...',
                'response_json_keys' => $response->json() ? array_keys($response->json()) : []
            ]);

            if ($response->successful() && isset($response->json()['application'])) {
                $applicationData = $response->json()['application'];
                
                // Log the application data for debugging
                Log::debug('Application data received from API', [
                    'app_id' => $applicationData['id'] ?? null,
                    'db_keys' => array_keys($applicationData),
                    'has_databases' => isset($applicationData['databases'])
                ]);
                
                // Extract database information if available
                $databaseInfo = [
                    'database_id' => null,
                    'database_name' => null,
                    'database_user_id' => null,
                    'database_username' => null,
                    'database_password' => null,
                    'database_host' => 'localhost'
                ];
                
                // Check if databases array exists
                if (isset($applicationData['databases']) && is_array($applicationData['databases']) && !empty($applicationData['databases'])) {
                    // Use the first database in the list
                    $database = $applicationData['databases'][0];
                    Log::debug('Database found in application data', [
                        'database_id' => $database['id'] ?? null,
                        'database_name' => $database['name'] ?? null,
                        'has_credentials' => isset($database['username']) && isset($database['password'])
                    ]);
                    
                    $databaseInfo = [
                        'database_id' => $database['id'] ?? null,
                        'database_name' => $database['name'] ?? null,
                        'database_user_id' => $database['database_user_id'] ?? null,
                        'database_username' => $database['username'] ?? null,
                        'database_password' => $database['password'] ?? null,
                        'database_host' => $database['hostname'] ?? 'localhost'
                    ];
                } else if (isset($applicationData['database_id'])) {
                    // Fallback to direct fields if they exist
                    $databaseInfo = [
                        'database_id' => $applicationData['database_id'] ?? null,
                        'database_name' => $applicationData['database_name'] ?? null,
                        'database_user_id' => $applicationData['database_user_id'] ?? null,
                        'database_username' => $applicationData['database_username'] ?? null,
                        'database_password' => $applicationData['database_password'] ?? null,
                        'database_host' => $applicationData['database_host'] ?? 'localhost'
                    ];
                } else {
                    // Try to find any related fields that might contain the database ID
                    foreach ($applicationData as $key => $value) {
                        if (strpos($key, 'database') !== false) {
                            Log::debug('Found potential database field', [
                                'key' => $key,
                                'value' => $value
                            ]);
                        }
                    }
                }
                
                // If we need to fetch database credentials and don't have them yet
                if ($fetchCredentials && !empty($databaseInfo['database_id']) && (empty($databaseInfo['database_username']) || empty($databaseInfo['database_password']))) {
                    Log::info('Fetching database credentials from database-users endpoint', [
                        'database_id' => $databaseInfo['database_id']
                    ]);
                    
                    try {
                        // Make a dedicated API call to get database users
                        $dbUsersEndpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/databases/{$databaseInfo['database_id']}/database-users?pagination=1";
                        
                        $dbUsersResponse = Http::withHeaders([
                            'Content-Type' => 'application/json',
                            'Authorization' => $this->apiKey,
                            'Accept' => 'application/json'
                        ])->get($this->apiUrl . $dbUsersEndpoint);
                        
                        Log::debug('Database users response', [
                            'status' => $dbUsersResponse->status(),
                            'success' => $dbUsersResponse->successful(),
                            'response_keys' => $dbUsersResponse->json() ? array_keys($dbUsersResponse->json()) : []
                        ]);
                        
                        if ($dbUsersResponse->successful() && isset($dbUsersResponse->json()['database_users']) && !empty($dbUsersResponse->json()['database_users'])) {
                            // Get the first database user
                            $dbUser = $dbUsersResponse->json()['database_users'][0];
                            
                            Log::debug('Found database user', [
                                'has_username' => isset($dbUser['username']),
                                'has_password' => isset($dbUser['password']),
                                'user_id' => $dbUser['id'] ?? null
                            ]);
                            
                            // Update credentials in our result
                            if (isset($dbUser['username'])) {
                                $databaseInfo['database_username'] = $dbUser['username'];
                            }
                            
                            if (isset($dbUser['password'])) {
                                $databaseInfo['database_password'] = $dbUser['password'];
                            }
                            
                            if (isset($dbUser['id'])) {
                                $databaseInfo['database_user_id'] = $dbUser['id'];
                            }
                            
                            Log::info('Successfully retrieved database credentials from database users', [
                                'has_username' => !empty($databaseInfo['database_username']),
                                'has_password' => !empty($databaseInfo['database_password']),
                                'database_user_id' => $databaseInfo['database_user_id'] ?? null
                            ]);
                        } else {
                            Log::warning('Failed to get database users or no users found', [
                                'status' => $dbUsersResponse->status(),
                                'has_users' => isset($dbUsersResponse->json()['database_users']),
                                'users_count' => isset($dbUsersResponse->json()['database_users']) ? count($dbUsersResponse->json()['database_users']) : 0
                            ]);
                        }
                    } catch (\Exception $e) {
                        Log::error('Exception while fetching database users: ' . $e->getMessage());
                    }
                }
                
                return [
                    'success' => true,
                    'message' => 'Database information retrieved successfully',
                    'data' => $databaseInfo
                ];
            } else {
                $errorMessage = 'Failed to retrieve application details. ';
                $errorData = $response->json();
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Application not found.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($errorData['message'])) {
                        $errorMessage .= ' - ' . $errorData['message'];
                    }
                }
                
                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => null
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Get database users (with credentials)
     * 
     * @param string $serverId Server ID
     * @param string $databaseId Database ID
     * @return array Response with success status, message, and data
     */
    public function getDatabaseUsers(string $serverId, string $databaseId): array
    {
        $this->loadSettings();
        
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        try {
            // Make a dedicated API call to get database users
            $dbUsersEndpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/databases/{$databaseId}/database-users?pagination=1";
            
            Log::debug('Getting database users', [
                'endpoint' => $this->apiUrl . $dbUsersEndpoint,
                'server_id' => $serverId,
                'database_id' => $databaseId
            ]);
            
            $dbUsersResponse = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json'
            ])->get($this->apiUrl . $dbUsersEndpoint);
            
            // Capture raw response for deeper inspection
            $rawResponse = $dbUsersResponse->body();
            Log::debug('Database users raw response: ' . substr($rawResponse, 0, 500) . (strlen($rawResponse) > 500 ? '...' : ''));
            
            // Safely get the JSON response, ensuring it's properly handled
            $responseJson = null;
            try {
                $responseJson = $dbUsersResponse->json();
            } catch (\Exception $e) {
                Log::error('Failed to parse JSON response: ' . $e->getMessage(), [
                    'raw_response' => $rawResponse
                ]);
            }
            
            // Log the full response structure for debugging
            if ($responseJson) {
                Log::debug('Database users response structure', [
                    'status' => $dbUsersResponse->status(),
                    'success' => $dbUsersResponse->successful(),
                    'response_keys' => is_array($responseJson) ? array_keys($responseJson) : 'non-array response',
                    'response_type' => gettype($responseJson)
                ]);
                
                // If response is an array, log a safer version
                if (is_array($responseJson)) {
                    $safeResponseLog = [];
                    foreach ($responseJson as $key => $value) {
                        if (is_array($value)) {
                            $safeResponseLog[$key] = '[Array with ' . count($value) . ' items]';
                        } else if (is_scalar($value)) {
                            $safeResponseLog[$key] = $value;
                        } else {
                            $safeResponseLog[$key] = gettype($value);
                        }
                    }
                    Log::debug('Database users response content overview', $safeResponseLog);
                }
            } else {
                Log::warning('Database users response is null or not JSON', [
                    'status' => $dbUsersResponse->status(),
                    'response_body_sample' => substr($rawResponse, 0, 100)
                ]);
            }
            
            // If we got a 200 OK response, the API call was successful even if we can't parse the result
            if ($dbUsersResponse->successful()) {
                // Case 1: Standard format with database_users key
                if (is_array($responseJson) && isset($responseJson['database_users']) && !empty($responseJson['database_users'])) {
                    // Get the first database user by default
                    $dbUser = $responseJson['database_users'][0];
                    
                    Log::info('Found database user in database_users array', [
                        'user_id' => $dbUser['id'] ?? 'missing',
                        'has_username' => isset($dbUser['username']),
                        'has_password' => isset($dbUser['password'])
                    ]);
                    
                    return [
                        'success' => true,
                        'message' => 'Database users retrieved successfully',
                        'data' => [
                            'database_username' => $dbUser['username'] ?? null,
                            'database_password' => $dbUser['password'] ?? null,
                        ],
                        'all_users' => $responseJson['database_users']
                    ];
                }
                
                // Case 2: Direct array of users
                if (is_array($responseJson) && !empty($responseJson)) {
                    // Check if the response is a direct array of users
                    $firstKey = array_key_first($responseJson);
                    $firstItem = $firstKey !== null ? $responseJson[$firstKey] : null;
                    
                    if (is_array($firstItem) && (isset($firstItem['username']) || isset($firstItem['id']))) {
                        $dbUser = $firstItem;
                        
                        Log::info('Found database user in direct array response', [
                            'user_id' => $dbUser['id'] ?? 'missing',
                            'has_username' => isset($dbUser['username']),
                            'has_password' => isset($dbUser['password'])
                        ]);
                        
                        return [
                            'success' => true,
                            'message' => 'Database users retrieved successfully',
                            'data' => [
                                'database_username' => $dbUser['username'] ?? null,
                                'database_password' => $dbUser['password'] ?? null,
                            ],
                            'all_users' => $responseJson
                        ];
                    }
                
                    // Case 3: Response has nested arrays - search through all keys
                    foreach ($responseJson as $key => $value) {
                        if (is_array($value) && !empty($value)) {
                            // If this is an array of arrays, look at the first item
                            $firstSubItem = is_array($value) && !empty($value) ? reset($value) : null;
                            
                            if (is_array($firstSubItem) && (isset($firstSubItem['username']) || isset($firstSubItem['id']))) {
                                $dbUser = $firstSubItem;
                                
                                Log::info('Found database user in key: ' . $key, [
                                    'user_id' => $dbUser['id'] ?? 'missing',
                                    'has_username' => isset($dbUser['username']),
                                    'has_password' => isset($dbUser['password'])
                                ]);
                                
                                return [
                                    'success' => true,
                                    'message' => 'Database users retrieved successfully',
                                    'data' => [
                                        'database_username' => $dbUser['username'] ?? null,
                                        'database_password' => $dbUser['password'] ?? null,
                                    ],
                                    'all_users' => $value
                                ];
                            }
                        }
                    }
                    
                    // Case 4: Direct single user object
                    if (isset($responseJson['username']) || isset($responseJson['id'])) {
                        Log::info('Response appears to be a direct user object', [
                            'user_id' => $responseJson['id'] ?? 'missing',
                            'has_username' => isset($responseJson['username']),
                            'has_password' => isset($responseJson['password'])
                        ]);
                        
                        return [
                            'success' => true,
                            'message' => 'Database users retrieved successfully',
                            'data' => [
                                'database_username' => $responseJson['username'] ?? null,
                                'database_password' => $responseJson['password'] ?? null,
                            ],
                            'all_users' => [$responseJson]
                        ];
                    }
                }
                
                // Case 5: The response format is not what we expected, but it was successful
                // This could be an empty database users list or a format we don't recognize
                Log::warning('Successful API call (200 OK) but could not find database users in the response structure', [
                    'response_type' => gettype($responseJson),
                    'available_keys' => is_array($responseJson) ? array_keys($responseJson) : 'non-array response',
                    'status' => $dbUsersResponse->status()
                ]);
                
                // Try to extract information from the raw response as a last resort
                if (strpos($rawResponse, 'username') !== false || strpos($rawResponse, 'password') !== false) {
                    Log::info('Username/password found in raw response, attempting to extract');
                    
                    // Very crude extraction - in a real scenario we would parse this more carefully
                    $matches = [];
                    preg_match('/"username"\s*:\s*"([^"]+)"/', $rawResponse, $usernameMatches);
                    preg_match('/"password"\s*:\s*"([^"]+)"/', $rawResponse, $passwordMatches);
                    preg_match('/"id"\s*:\s*"([^"]+)"/', $rawResponse, $idMatches);
                    
                    $username = $usernameMatches[1] ?? null;
                    $password = $passwordMatches[1] ?? null;
                    $id = $idMatches[1] ?? null;
                    
                    if ($username || $password || $id) {
                        Log::info('Extracted credentials from raw response', [
                            'found_username' => !empty($username),
                            'found_password' => !empty($password),
                            'found_id' => !empty($id)
                        ]);
                        
                        return [
                            'success' => true,
                            'message' => 'Database users extracted from raw response',
                            'data' => [
                                'database_username' => $username,
                                'database_password' => $password,
                            ],
                            'extraction_method' => 'raw_response'
                        ];
                    }
                }
                
                // If we got here with a 200 OK, we'll assume there's just no database users yet
                // We'll return success but with null data to avoid triggering errors
                return [
                    'success' => true,
                    'message' => 'API call successful but no database users found in the response',
                    'data' => [
                        'database_username' => null,
                        'database_password' => null,
                    ],
                    'note' => 'This might be a newly created database with no users yet'
                ];
            } else {
                // The API call was not successful
                $errorMessage = 'Failed to retrieve database users. ';
                
                if ($dbUsersResponse->status() === 401 || $dbUsersResponse->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($dbUsersResponse->status() === 404) {
                    $errorMessage .= 'Database not found.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $dbUsersResponse->status();
                    if (is_array($responseJson) && isset($responseJson['message'])) {
                        $errorMessage .= ' - ' . $responseJson['message'];
                    }
                }
                
                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => null
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }

    /**
     * Delete a database from the server
     * 
     * @param string $serverId Server ID
     * @param string $databaseId Database ID
     * @param string|null $applicationId Optional application ID if we want to try removing the database from application first
     * @return array Response with success status, message, and data
     */
    public function deleteDatabase(string $serverId, string $databaseId, string $applicationId = null): array
    {
        $this->loadSettings();
        
        if (!$this->isConfigured) {
            return [
                'success' => false,
                'message' => 'ServerAvatar API is not configured. Please check your settings.',
                'data' => null
            ];
        }

        // If we have an application ID, first try to remove the database from the application
        if ($applicationId) {
            try {
                // First attempt to remove the database from the application
                $removeEndpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/applications/{$applicationId}/remove-database";
                
                Log::debug('ServerAvatar API Remove Database from Application Request', [
                    'endpoint' => $this->apiUrl . $removeEndpoint,
                    'organization_id' => $this->organizationId,
                    'server_id' => $serverId,
                    'application_id' => $applicationId,
                    'database_id' => $databaseId
                ]);
                
                $removeResponse = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => $this->apiKey,
                    'Accept' => 'application/json'
                ])->post($this->apiUrl . $removeEndpoint, [
                    'database_id' => $databaseId
                ]);
                
                Log::debug('ServerAvatar API Remove Database from Application Response', [
                    'status' => $removeResponse->status(),
                    'body' => $removeResponse->body(),
                    'json' => $removeResponse->json()
                ]);
                
                // Even if this fails, we'll still try to delete the database directly
            } catch (\Exception $e) {
                Log::warning('Error removing database from application: ' . $e->getMessage());
                // Continue to delete the database directly
            }
        }

        try {
            $endpoint = "/organizations/{$this->organizationId}/servers/{$serverId}/databases/{$databaseId}";
            
            // Log the request details for debugging
            Log::debug('ServerAvatar API Delete Database Request', [
                'endpoint' => $this->apiUrl . $endpoint,
                'organization_id' => $this->organizationId,
                'server_id' => $serverId,
                'database_id' => $databaseId
            ]);
            
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $this->apiKey,
                'Accept' => 'application/json'
            ])->delete($this->apiUrl . $endpoint);
            
            // Log the response for debugging
            Log::debug('ServerAvatar API Delete Database Response', [
                'status' => $response->status(),
                'body' => $response->body(),
                'json' => $response->json()
            ]);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => $response->json()['message'] ?? 'Database deleted successfully',
                    'data' => $response->json()
                ];
            } else {
                $errorMessage = 'Failed to delete database. ';
                $errorData = $response->json();
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Server, organization or database not found.';
                    // Consider this a "success" since the database doesn't exist anyway
                    return [
                        'success' => true,
                        'message' => 'Database not found or already deleted',
                        'data' => null
                    ];
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($errorData['message'])) {
                        $errorMessage .= ' - ' . $errorData['message'];
                    }
                }
                
                Log::error('ServerAvatar API Error: ' . $errorMessage);
                
                return [
                    'success' => false,
                    'message' => $errorMessage,
                    'data' => $errorData ?? null
                ];
            }
        } catch (\Exception $e) {
            Log::error('ServerAvatar API Exception: ' . $e->getMessage());
            
            return [
                'success' => false,
                'message' => 'Failed to connect to ServerAvatar API: ' . $e->getMessage(),
                'data' => null
            ];
        }
    }
}