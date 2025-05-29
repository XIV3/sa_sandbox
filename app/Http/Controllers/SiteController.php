<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\SelectedServer;
use App\Services\CloudflareService;
use App\Services\ServerAvatarService;
use App\Services\SystemSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use App\Mail\SiteCreated;

class SiteController extends Controller
{
    protected $systemSettings;

    protected $serverAvatarService;

    protected $cloudflareService;

    public function __construct(
        SystemSettingsService $systemSettings, 
        ServerAvatarService $serverAvatarService,
        CloudflareService $cloudflareService
    ) {
        $this->systemSettings = $systemSettings;
        $this->serverAvatarService = $serverAvatarService;
        $this->cloudflareService = $cloudflareService;
    }

    public function index()
    {
        $sites = Site::with('server')->latest()->get();
        $servers = SelectedServer::all();
        $domain = $this->systemSettings->getDomain();
        
        return view('admin.sites', compact('sites', 'servers', 'domain'));
    }

    public function create()
    {
        return redirect()->route('admin.sites.index')
            ->with('openCreateModal', true);
    }

    public function store(Request $request)
    {        $subdomain = $request->input('subdomain');
        if (!$subdomain) {
            return redirect()->route('admin.sites.index')
                ->withErrors(['subdomain' => 'Subdomain is required'])
                ->withInput()
                ->with('openCreateModal', true)
                ->with('error', 'Subdomain is required');
        }
        
        $this->systemSettings->clearCache('domain');
        
        $systemDomain = $this->systemSettings->getUncachedDomain();
        $domain = $subdomain . '-wp.' . $systemDomain;
        
        $validationRules = [
            'subdomain' => 'required|string|max:252|regex:/^[a-z0-9-]+$/',
            'email' => 'nullable|email|required_if:reminder,on',
            'reminder' => 'nullable|string',
        ];
        
        $validationMessages = [
            'subdomain.regex' => 'The subdomain may only contain lowercase letters, numbers, and hyphens.',
            'subdomain.unique' => 'This subdomain is already taken. Please choose another one.',
            'email.required_if' => 'The email field is required when reminder is enabled.',
        ];
        
        // Determine if the request is coming from the homepage or admin panel
        $isFromHomepage = $request->route()->getName() === 'home.sites.store';
        
        if ($isFromHomepage || !auth()->check()) {
            $validationRules['terms'] = 'required|accepted';
            $validationMessages['terms.required'] = 'You must agree to the Terms of Service and Privacy Policy.';
            $validationMessages['terms.accepted'] = 'You must agree to the Terms of Service and Privacy Policy.';
        }
        
        $validator = validator($request->all(), $validationRules, $validationMessages);
        
        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Please fix the validation errors below.'
                ], 422);
            }
            
            if ($request->route()->getName() === 'home.sites.store') {
                return redirect()->route('home')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('error', 'Please fix the validation errors below.');
            } else {
                return redirect()->route('admin.sites.index')
                    ->withErrors($validator)
                    ->withInput()
                    ->with('openCreateModal', true)
                    ->with('error', 'Please fix the validation errors below.');
            }
        }
        
        if (Site::where('domain', $domain)->exists()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'errors' => ['subdomain' => ['This subdomain is already taken. Please choose another one.']],
                    'message' => 'This subdomain is already taken.'
                ], 422);
            }
            
            return redirect()->route('admin.sites.index')
                ->withErrors(['subdomain' => 'This subdomain is already taken. Please choose another one.'])
                ->withInput()
                ->with('openCreateModal', true)
                ->with('error', 'Please fix the validation errors below.');
        }
        
        $validated = $validator->validated();
        
        if (!$this->serverAvatarService->isConfigured()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'ServerAvatar API is not properly configured. Please check API settings.'
                ], 500);
            }
            
            return redirect()->route('admin.sites.index')
                ->with('error', 'ServerAvatar API is not properly configured. Please check API settings.')
                ->withInput()
                ->with('openCreateModal', true);
        }
        
        // Get all available connected servers
        $servers = SelectedServer::where('connection_status', 'connected')->get();
        
        if ($servers->isEmpty()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No connected server available to create site. Please add a connected server first.'
                ], 500);
            }
            
            return redirect()->route('admin.sites.index')
                ->with('error', 'No connected server available to create site. Please add a connected server first.')
                ->withInput()
                ->with('openCreateModal', true);
        }
        
        // Randomly select one server instead of trying each one
        $server = $servers->random();
        $usedServer = $server;
        $createResponse = null;
        
        // Attempt to create WordPress site on the randomly selected server
        $createResponse = $this->serverAvatarService->createWordPressSite(
            $server->server_id,
            $domain
        );
        
        // If there's a server error, try one more time with a different server
        if (!$createResponse['success'] && 
            !(isset($createResponse['error_code']) && $createResponse['error_code'] === 'duplicate_domain') && 
            !(strpos(strtolower($createResponse['message'] ?? ''), 'duplicate domain') !== false) && 
            !(strpos(strtolower($createResponse['message'] ?? ''), 'domain name found') !== false)) {
            
            // Mark the first server as in maintenance
            SelectedServer::where('id', $server->id)->update(['connection_status' => 'maintenance']);
            
            Log::warning('First server failed to create WordPress site, trying a different server', [
                'server_id' => $server->server_id,
                'error' => $createResponse['message'] ?? 'Unknown error'
            ]);
            
            // Get remaining available servers
            $remainingServers = SelectedServer::where('connection_status', 'connected')
                ->where('id', '!=', $server->id)
                ->get();
                
            if ($remainingServers->isNotEmpty()) {
                // Try with a second random server
                $server = $remainingServers->random();
                $usedServer = $server;
                
                $createResponse = $this->serverAvatarService->createWordPressSite(
                    $server->server_id,
                    $domain
                );
            }
        }
        
        // Get database information if site creation was successful
        if ($createResponse['success'] && isset($createResponse['data']['application']['id'])) {
            $databaseResponse = $this->serverAvatarService->getDatabaseInformation(
                $server->server_id,
                $createResponse['data']['application']['id']
            );
            
            if ($databaseResponse['success']) {
                Log::info('Database information retrieved successfully', [
                    'database_id' => $databaseResponse['data']['database_id'] ?? null,
                    'database_name' => $databaseResponse['data']['database_name'] ?? null,
                    'full_data' => $databaseResponse['data']
                ]);
                
                if (empty($databaseResponse['data']['database_id'])) {
                    Log::warning('Failed to capture database ID from application data');
                }
                $createResponse['data']['database'] = $databaseResponse['data'];
            } else {
                Log::warning('Failed to retrieve database information', [
                    'error' => $databaseResponse['message']
                ]);
            }
        }
        
        if (!$createResponse || !$usedServer) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'All available servers failed to create the WordPress site. Please try again later.'
                ], 500);
            }
            
            return redirect()->route('admin.sites.index')
                ->with('error', 'All available servers failed to create the WordPress site. Please try again later.')
                ->withInput()
                ->with('openCreateModal', true);
        }
        
        $server = $usedServer;
        
        if (!$createResponse['success']) {
            $errorMessage = 'Failed to create WordPress site: ' . $createResponse['message'];
            Log::error($errorMessage, ['response' => $createResponse]);
            
            if (isset($createResponse['error_code']) && $createResponse['error_code'] === 'duplicate_domain') {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['subdomain' => ['This subdomain is already taken. Please choose another one.']],
                        'message' => 'This domain name is already in use. Please choose a different subdomain.'
                    ], 422);
                }
                
                return redirect()->route('admin.sites.index')
                    ->withErrors(['subdomain' => 'This subdomain is already taken. Please choose another one.'])
                    ->withInput()
                    ->with('openCreateModal', true)
                    ->with('error', 'This domain name is already in use. Please choose a different subdomain.');
            }
            
            if (isset($createResponse['error_code']) && $createResponse['error_code'] === 'server_error') {
                // Try a different server next time
                SelectedServer::where('id', $server->id)->update(['connection_status' => 'maintenance']);
                
                // Log the issue
                Log::error('Server error during WordPress installation', [
                    'server_id' => $server->server_id,
                    'selected_server_id' => $server->id,
                    'domain' => $domain
                ]);
                
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'The server encountered an error during WordPress installation. Please try again with a different subdomain.'
                    ], 500);
                }
                
                return redirect()->route('admin.sites.index')
                    ->withInput()
                    ->with('openCreateModal', true)
                    ->with('error', 'The server encountered an error during WordPress installation. Please try again with a different subdomain.');
            }
            
            if (strpos(strtolower($createResponse['message']), 'duplicate domain') !== false ||
                strpos(strtolower($createResponse['message']), 'domain name found') !== false) {
                
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'errors' => ['subdomain' => ['This subdomain is already taken. Please choose another one.']],
                        'message' => 'Domain already exists. Please choose a different subdomain.'
                    ], 422);
                }
                
                return redirect()->route('admin.sites.index')
                    ->withErrors(['subdomain' => 'This subdomain is already taken. Please choose another one.'])
                    ->withInput()
                    ->with('openCreateModal', true)
                    ->with('error', 'Domain already exists. Please choose a different subdomain.');
            }
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 500);
            }
            
            return redirect()->route('admin.sites.index')
                ->with('error', $errorMessage)
                ->withInput()
                ->with('openCreateModal', true);
        }
        
        $applicationData = $createResponse['data']['application'] ?? null;
        
        if (!$applicationData || !isset($applicationData['id'])) {
            $errorMessage = 'Missing application data in API response';
            Log::error($errorMessage, ['response' => $createResponse]);
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ], 500);
            }
            
            return redirect()->route('admin.sites.index')
                ->with('error', $errorMessage)
                ->withInput()
                ->with('openCreateModal', true);
        }
        
        try {
            Log::info('Attempting to install SSL certificate', [
                'server_id' => $server->server_id,
                'application_id' => $applicationData['id'],
                'use_custom_ssl' => true
            ]);
            
            // First try with custom SSL
            $sslResponse = $this->serverAvatarService->installSSL(
                $server->server_id,
                $applicationData['id'],
                true, // Use custom SSL if available
                true  // Force HTTPS
            );
            
            if (!$sslResponse['success']) {
                // Log the error but try again with automatic SSL
                Log::warning('Failed to install custom SSL certificate: ' . $sslResponse['message'], [
                    'server_id' => $server->server_id,
                    'application_id' => $applicationData['id'],
                    'response' => $sslResponse
                ]);
                
                // Fall back to automatic SSL
                Log::info('Falling back to automatic SSL installation');
                $sslResponse = $this->serverAvatarService->installSSL(
                    $server->server_id,
                    $applicationData['id'],
                    false, // Use automatic SSL
                    true   // Force HTTPS
                );
                
                if (!$sslResponse['success']) {
                    // Both custom and automatic SSL failed
                    Log::error('Failed to install both custom and automatic SSL certificate: ' . $sslResponse['message'], [
                        'server_id' => $server->server_id,
                        'application_id' => $applicationData['id'],
                        'response' => $sslResponse
                    ]);
                    $sslInstalled = false;
                } else {
                    $sslInstalled = true;
                    $sslType = 'automatic';
                    Log::info('Successfully installed automatic SSL certificate');
                }
            } else {
                $sslInstalled = true;
                $sslType = 'custom';
                Log::info('Successfully installed custom SSL certificate');
            }
        } catch (\Exception $e) {
            // Catch any exceptions and log them, but continue with site creation
            Log::error('Exception during SSL installation: ' . $e->getMessage(), [
                'exception' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            $sslInstalled = false;
            $sslType = null;
        }
        
        // Store credentials for reference
        $credentials = $createResponse['data']['credentials'] ?? [];
        
        // Get database information
        $databaseInfo = $createResponse['data']['database'] ?? [];
        
        // Get default deletion time from system settings
        $defaultDeletionHours = (int)$this->systemSettings->get('default_deletion_time', 24); // Default to 24 hours if not set
        
        // Determine if the request is coming from the homepage or admin panel
        $isFromHomepage = $request->route()->getName() === 'home.sites.store';
        
        // Prepare site data
        $siteData = [
            'name' => $validated['subdomain'],
            'domain' => $domain,
            'selected_server_id' => $server->id,
            'server_id' => $server->server_id,
            'status' => 'active',
            'uuid' => Str::random(32),
            'php_version' => $applicationData['php_version'] ?? '8.2',
            'reminder' => isset($validated['reminder']) && $validated['reminder'] === 'on',
            'email' => isset($validated['reminder']) && $validated['reminder'] === 'on' ? $validated['email'] : null,
            // Set expiration time based on system settings
            'expires_at' => now()->addMinutes(4),// $defaultDeletionHours != 0 ? now()->addHours($defaultDeletionHours) : null,
            // Mark sites created from the homepage as public
            'is_public' => $isFromHomepage ? true : false,
            // Store ServerAvatar application details in separate columns for easier access
            'application_id' => $applicationData['id'] ?? null,
            'system_username' => $credentials['system_username'] ?? null,
            'wp_username' => $credentials['wp_username'] ?? null,
            'database_name' => $credentials['database_name'] ?? null,
            // Store database details from API response
            'database_id' => $databaseInfo['database_id'] ?? null,
            'database_username' => $databaseInfo['database_username'] ?? null,
            'database_password' => $databaseInfo['database_password'] ?? null,
            'database_host' => $databaseInfo['database_host'] ?? 'localhost',
            // Also keep in site_data for backward compatibility and to store passwords
            'site_data' => [
                'application_id' => $applicationData['id'] ?? null,
                'wp_username' => $credentials['wp_username'] ?? null,
                'wp_password' => $credentials['wp_password'] ?? null,
                'system_username' => $credentials['system_username'] ?? null,
                'system_password' => $credentials['system_password'] ?? null,
                'database_name' => $credentials['database_name'] ?? null,
                'database_id' => $databaseInfo['database_id'] ?? null,
                'database_username' => $databaseInfo['database_username'] ?? null,
                'database_password' => $databaseInfo['database_password'] ?? null,
                'database_host' => $databaseInfo['database_host'] ?? 'localhost',
                'created_at' => now()->toDateTimeString(),
                'expires_at' => null, // (!$defaultDeletionHours) ? now()->addHours($defaultDeletionHours)->toDateTimeString() : 'NEVER',
                'ssl_installed' => $sslInstalled ?? false,
                'ssl_type' => $sslType ?? null,
                'ssl_installation_attempted' => true,
            ],
        ];
        
        // Create the site record in our database
        $site = Site::create($siteData);

        // Create DNS record in Cloudflare if Cloudflare integration is configured
        if ($this->cloudflareService->isConfigured() && !empty($server->ip_address)) {
            try {
                Log::info('Creating DNS A record for new site', [
                    'domain' => $site->domain,
                    'subdomain' => $site->domain, // 'subdomain' => $validated['subdomain'],
                    'ip_address' => $server->ip_address
                ]);

                // Create the DNS record
                $dnsResponse = $this->cloudflareService->createARecord(
                    $site->domain,          // $validated['subdomain'], // Just the subdomain portion
                    $server->ip_address,    // The server's IP address
                    true                    // Proxied through Cloudflare
                );

                if ($dnsResponse['success']) {
                    // Store the DNS record ID for future reference
                    $site->update([
                        'cloudflare_record_id' => $dnsResponse['record_id'],
                        'has_dns_record' => true
                    ]);

                    // Add DNS record information to site_data
                    $siteData = $site->site_data;
                    $siteData['dns_record'] = [
                        'created_at' => now()->toDateTimeString(),
                        'record_id' => $dnsResponse['record_id'],
                        'type' => 'A',
                        'name' => $site->domain,
                        'ip_address' => $server->ip_address
                    ];
                    $site->site_data = $siteData;
                    $site->save();

                    Log::info('Successfully created DNS A record', [
                        'record_id' => $dnsResponse['record_id'],
                        'domain' => $site->domain
                    ]);
                } else {
                    Log::warning('Failed to create DNS A record', [
                        'domain' => $site->domain,
                        'error' => $dnsResponse['message']
                    ]);
                }
            } catch (\Exception $e) {
                // Log the error but don't fail the entire site creation
                Log::error('Exception during DNS record creation: ' . $e->getMessage(), [
                    'exception' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        } else {
            Log::info('Skipping DNS record creation - Cloudflare not configured or server IP missing', [
                'cloudflare_configured' => $this->cloudflareService->isConfigured(),
                'server_ip' => $server->ip_address ?? 'missing'
            ]);
        }

        // Before redirecting, try to fetch database credentials using the database-users endpoint
        if (!empty($site->database_id) && !empty($site->server_id)) {
            try {
                Log::info('Fetching database credentials from database-users endpoint before redirecting', [
                    'site_id' => $site->id,
                    'database_id' => $site->database_id,
                    'server_id' => $site->server_id
                ]);
                
                // Use the dedicated method to get database users with credentials
                $dbUsersResponse = $this->serverAvatarService->getDatabaseUsers(
                    $site->server_id,
                    $site->database_id
                );
                
                if ($dbUsersResponse['success']) {
                    // Extract credentials from the first database user
                    $dbUsername = $dbUsersResponse['data']['database_username'] ?? null;
                    $dbPassword = $dbUsersResponse['data']['database_password'] ?? null;
                    
                    Log::info('Retrieved database user credentials', [
                        'has_username' => !empty($dbUsername),
                        'has_password' => !empty($dbPassword)
                    ]);
                    
                    if (!empty($dbUsername) || !empty($dbPassword)) {
                        // Update the site record with the credentials
                        $updateData = [];
                        
                        if (!empty($dbUsername)) {
                            $updateData['database_username'] = $dbUsername;
                        }
                        
                        if (!empty($dbPassword)) {
                            $updateData['database_password'] = $dbPassword;
                        }
                        
                        if (!empty($updateData)) {
                            Log::info('Updating site with database credentials', [
                                'site_id' => $site->id,
                                'updating_fields' => array_keys($updateData)
                            ]);
                            
                            // Update the database fields
                            $site->update($updateData);
                            
                            // Also update the site_data array for consistency
                            $siteData = $site->site_data;
                            if (!empty($dbUsername)) {
                                $siteData['database_username'] = $dbUsername;
                            }
                            if (!empty($dbPassword)) {
                                $siteData['database_password'] = $dbPassword;
                            }
                            $site->site_data = $siteData;
                            $site->save();
                            
                            // Refresh the site object to get the updated data
                            $site->refresh();
                            
                            Log::info('Successfully updated site with database credentials');
                        }
                    } else {
                        Log::warning('Database user credentials were empty');
                    }
                } else {
                    Log::warning('Failed to get database users from ServerAvatar API: ' . ($dbUsersResponse['message'] ?? 'Unknown error'));
                }
            } catch (\Exception $e) {
                Log::error('Exception while fetching database users: ' . $e->getMessage(), [
                    'exception' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                // Continue with redirect even if we couldn't get the credentials
            }
        } else {
            Log::warning('Could not fetch database credentials - missing database_id or server_id', [
                'site_id' => $site->id,
                'has_database_id' => !empty($site->database_id),
                'has_server_id' => !empty($site->server_id)
            ]);
        }
        
        // Send email notification if user provided an email address
        if ($site->email) {
            try {
                Log::info('Sending site creation email notification', [
                    'site_id' => $site->id,
                    'site_uuid' => $site->uuid,
                    'email' => $site->email
                ]);
                
                Mail::to($site->email)->send(new SiteCreated($site));
                
                Log::info('Site creation email notification sent successfully');
            } catch (\Exception $e) {
                // Log the error but don't fail the entire site creation process
                Log::error('Failed to send site creation email notification: ' . $e->getMessage(), [
                    'site_id' => $site->id,
                    'site_uuid' => $site->uuid,
                    'email' => $site->email,
                    'exception' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
        
        // Check if this is an AJAX request
        if ($request->ajax()) {
            // For AJAX requests, determine the redirect based on whether it's from homepage or admin panel
            $redirectUrl = $isFromHomepage 
                ? route('sites.public.show', $site->uuid)
                : route('admin.sites.show', $site->uuid);
                
            return response()->json([
                'success' => true,
                'message' => 'WordPress site created successfully!',
                'redirect' => $redirectUrl
            ]);
        }

        // For regular form submissions, determine redirect based on source
        if ($isFromHomepage) {
            // If created from homepage, redirect to public site view
            return redirect()->route('sites.public.show', $site->uuid)
                ->with('success', 'WordPress site created successfully!');
        } else {
            // If created from admin panel, redirect to admin sites index
            return redirect()->route('admin.sites.index')
                ->with('success', 'WordPress site created successfully!');
        }
    }

    public function show($uuid)
    {
        $site = Site::where('uuid', $uuid)->firstOrFail();
        $site->load('server');
        
        // Initialize application details variable
        $applicationDetails = null;
        
        // Check if we have the necessary information to fetch application details
        if ($site->application_id && $site->server_id) {
            // Log the attempt to fetch application details
            Log::info('Attempting to fetch application details', [
                'site_id' => $site->id,
                'site_uuid' => $site->uuid,
                'server_id' => $site->server_id,
                'application_id' => $site->application_id
            ]);
            
            // Fetch application details from ServerAvatar API
            $response = $this->serverAvatarService->getApplicationDetails(
                $site->server_id,
                $site->application_id
            );
            
            if ($response['success']) {
                $applicationDetails = $response['data'];
                Log::info('Successfully fetched application details', [
                    'response_keys' => array_keys($response['data']),
                    'has_php_settings' => isset($response['data']['php_settings']),
                    'has_application' => isset($response['data']['application'])
                ]);
            } else {
                // Log the error but don't fail the page load
                Log::error('Failed to fetch application details: ' . $response['message']);
            }
        } else {
            Log::warning('Cannot fetch application details, missing required data', [
                'has_application_id' => !empty($site->application_id),
                'has_server_id' => !empty($site->server_id),
                'site_id' => $site->id,
                'site_uuid' => $site->uuid
            ]);
        }
        
        return view('admin.sites.show', compact('site', 'applicationDetails'));
    }
    
    public function togglePublic(Request $request, Site $site)
    {
        $validated = $request->validate([
            'is_public' => 'required|boolean',
        ]);
        
        $site->update([
            'is_public' => $validated['is_public'],
        ]);
        
        return response()->json([
            'success' => true,
            'is_public' => $site->is_public,
        ]);
    }
    
    public function publicShow($uuid)
    {
        $site = Site::where('uuid', $uuid)
                    ->where('is_public', true)
                    ->firstOrFail();
                    
        $site->load('server');
        
        // Initialize application details variable
        $applicationDetails = null;
        
        // Check if we have the necessary information to fetch application details
        if ($site->application_id && $site->server_id) {
            // Fetch application details from ServerAvatar API
            $response = $this->serverAvatarService->getApplicationDetails(
                $site->server_id,
                $site->application_id
            );
            
            if ($response['success']) {
                $applicationDetails = $response['data'];
            }
        }
        
        return view('sites.public.show', compact('site', 'applicationDetails'));
    }


    public function destroy(Site $site)
    {
        $warnings = [];
        $serverDeleteSuccess = true;
        $dnsDeleteSuccess = true;
        $databaseDeleteSuccess = true;

        // Try to delete the application from ServerAvatar if application_id is available
        if ($site->application_id && $site->server_id) {
            try {
                $deleteResponse = $this->serverAvatarService->deleteApplication(
                    $site->server_id,
                    $site->application_id
                );
                
                if (!$deleteResponse['success']) {
                    Log::warning('Failed to delete application from ServerAvatar', [
                        'site_id' => $site->id,
                        'server_id' => $site->server_id,
                        'application_id' => $site->application_id,
                        'error' => $deleteResponse['message'] ?? 'Unknown error'
                    ]);
                    
                    $serverDeleteSuccess = false;
                    $warnings[] = 'There was an issue removing the site from the server: ' . 
                        ($deleteResponse['message'] ?? 'Unknown error');
                } else {
                    Log::info('Application deleted from ServerAvatar', [
                        'site_id' => $site->id,
                        'server_id' => $site->server_id,
                        'application_id' => $site->application_id
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Exception while deleting application from ServerAvatar', [
                    'site_id' => $site->id,
                    'server_id' => $site->server_id,
                    'application_id' => $site->application_id,
                    'exception' => $e->getMessage()
                ]);
                
                $serverDeleteSuccess = false;
                $warnings[] = 'There was an error removing the site from the server: ' . $e->getMessage();
            }
        }
        
        // Try to delete the database if database_id is available
        if ($site->database_id && $site->server_id) {
            try {
                Log::info('Deleting database from ServerAvatar', [
                    'site_id' => $site->id,
                    'server_id' => $site->server_id,
                    'database_id' => $site->database_id,
                    'database_name' => $site->database_name
                ]);
                
                $databaseResponse = $this->serverAvatarService->deleteDatabase(
                    $site->server_id,
                    $site->database_id,
                    $site->application_id // Pass application ID to first remove the database from the application
                );
                
                if (!$databaseResponse['success']) {
                    Log::warning('Failed to delete database from ServerAvatar', [
                        'site_id' => $site->id,
                        'server_id' => $site->server_id,
                        'database_id' => $site->database_id,
                        'error' => $databaseResponse['message'] ?? 'Unknown error'
                    ]);
                    
                    $databaseDeleteSuccess = false;
                    $warnings[] = 'There was an issue removing the database from the server: ' . 
                        ($databaseResponse['message'] ?? 'Unknown error');
                } else {
                    Log::info('Database deleted from ServerAvatar', [
                        'site_id' => $site->id,
                        'server_id' => $site->server_id,
                        'database_id' => $site->database_id,
                        'database_name' => $site->database_name
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Exception while deleting database from ServerAvatar', [
                    'site_id' => $site->id,
                    'server_id' => $site->server_id,
                    'database_id' => $site->database_id,
                    'exception' => $e->getMessage()
                ]);
                
                $databaseDeleteSuccess = false;
                $warnings[] = 'There was an error removing the database from the server: ' . $e->getMessage();
            }
        }

        // Delete DNS record from Cloudflare if available
        if ($site->has_dns_record && $site->cloudflare_record_id) {
            try {
                Log::info('Deleting DNS record from Cloudflare', [
                    'site_id' => $site->id,
                    'domain' => $site->domain,
                    'record_id' => $site->cloudflare_record_id
                ]);

                $dnsResponse = $this->cloudflareService->deleteDnsRecord($site->cloudflare_record_id);
                
                if (!$dnsResponse['success']) {
                    Log::warning('Failed to delete DNS record from Cloudflare', [
                        'site_id' => $site->id,
                        'domain' => $site->domain,
                        'record_id' => $site->cloudflare_record_id,
                        'error' => $dnsResponse['message'] ?? 'Unknown error'
                    ]);
                    
                    $dnsDeleteSuccess = false;
                    $warnings[] = 'There was an issue removing the DNS record from Cloudflare: ' . 
                        ($dnsResponse['message'] ?? 'Unknown error');
                } else {
                    Log::info('DNS record deleted from Cloudflare', [
                        'site_id' => $site->id,
                        'domain' => $site->domain,
                        'record_id' => $site->cloudflare_record_id
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Exception while deleting DNS record from Cloudflare', [
                    'site_id' => $site->id,
                    'domain' => $site->domain,
                    'record_id' => $site->cloudflare_record_id,
                    'exception' => $e->getMessage()
                ]);
                
                $dnsDeleteSuccess = false;
                $warnings[] = 'There was an error removing the DNS record from Cloudflare: ' . $e->getMessage();
            }
        }
        
        // Delete the site from our database
        $site->delete();
        
        // Determine the appropriate response message
        if ($serverDeleteSuccess && $dnsDeleteSuccess && $databaseDeleteSuccess) {
            return redirect()->route('admin.sites.index')
                ->with('success', 'Site deleted successfully from our database, the server, database, and DNS records.');
        } elseif (!empty($warnings)) {
            return redirect()->route('admin.sites.index')
                ->with('warning', 'Site deleted from our database, but with issues: ' . implode(' ', $warnings));
        } else {
            return redirect()->route('admin.sites.index')
                ->with('success', 'Site deleted successfully.');
        }
    }
}
