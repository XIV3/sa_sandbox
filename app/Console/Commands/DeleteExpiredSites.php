<?php

namespace App\Console\Commands;

use App\Models\Site;
use App\Services\CloudflareService;
use App\Services\ServerAvatarService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteExpiredSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sites:delete-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all sites that have passed their expiration date';

    /**
     * The ServerAvatarService instance.
     *
     * @var \App\Services\ServerAvatarService
     */
    protected $serverAvatarService;

    /**
     * The CloudflareService instance.
     *
     * @var \App\Services\CloudflareService
     */
    protected $cloudflareService;

    /**
     * Create a new command instance.
     *
     * @param \App\Services\ServerAvatarService $serverAvatarService
     * @param \App\Services\CloudflareService $cloudflareService
     * @return void
     */
    public function __construct(
        ServerAvatarService $serverAvatarService,
        CloudflareService $cloudflareService
    ) {
        parent::__construct();
        $this->serverAvatarService = $serverAvatarService;
        $this->cloudflareService = $cloudflareService;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Checking for expired sites...');
        
        // Get all sites that have passed their expiration date
        $expiredSites = Site::where('expires_at', '<', now())->get();
        
        if ($expiredSites->isEmpty()) {
            $this->info('No expired sites found.');
            return 0;
        }
        
        $count = 0;
        foreach ($expiredSites as $site) {
            $this->info("Processing expired site: {$site->name} ({$site->domain})");
            
            $warnings = [];
            $serverDeleteSuccess = true;
            $dnsDeleteSuccess = true;
            $databaseDeleteSuccess = true;

            // Step 1: Try to delete the application from ServerAvatar if application_id is available
            if ($site->application_id && $site->server_id) {
                try {
                    $this->info("Deleting application from ServerAvatar: Server ID {$site->server_id}, App ID {$site->application_id}");
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
                        $this->warn("Failed to delete application: " . ($deleteResponse['message'] ?? 'Unknown error'));
                    } else {
                        Log::info('Application deleted from ServerAvatar', [
                            'site_id' => $site->id,
                            'server_id' => $site->server_id,
                            'application_id' => $site->application_id
                        ]);
                        $this->info("Application deleted successfully from ServerAvatar");
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
                    $this->error("Error deleting application: " . $e->getMessage());
                }
            }

            // Step 2: Try to delete the database if database_id is available
            if ($site->database_id && $site->server_id) {
                try {
                    $this->info("Deleting database from ServerAvatar: Server ID {$site->server_id}, DB ID {$site->database_id}");
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
                        $this->warn("Failed to delete database: " . ($databaseResponse['message'] ?? 'Unknown error'));
                    } else {
                        Log::info('Database deleted from ServerAvatar', [
                            'site_id' => $site->id,
                            'server_id' => $site->server_id,
                            'database_id' => $site->database_id,
                            'database_name' => $site->database_name
                        ]);
                        $this->info("Database deleted successfully from ServerAvatar");
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
                    $this->error("Error deleting database: " . $e->getMessage());
                }
            }

            // Step 3: Delete DNS record from Cloudflare if available
            if ($site->has_dns_record && $site->cloudflare_record_id) {
                try {
                    $this->info("Deleting DNS record from Cloudflare: Record ID {$site->cloudflare_record_id}");
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
                        $this->warn("Failed to delete DNS record: " . ($dnsResponse['message'] ?? 'Unknown error'));
                    } else {
                        Log::info('DNS record deleted from Cloudflare', [
                            'site_id' => $site->id,
                            'domain' => $site->domain,
                            'record_id' => $site->cloudflare_record_id
                        ]);
                        $this->info("DNS record deleted successfully from Cloudflare");
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
                    $this->error("Error deleting DNS record: " . $e->getMessage());
                }
            }
            
            // Step 4: Delete the site from our database
            try {
                $this->info("Deleting site from database: {$site->id}");
                $site->delete();
                $this->info("Site {$site->name} deleted from database successfully");
                $count++;
            } catch (\Exception $e) {
                $this->error("Error deleting site from database: " . $e->getMessage());
                Log::error("Error deleting site from database: " . $e->getMessage(), [
                    'site_id' => $site->id,
                    'exception' => $e->getMessage()
                ]);
                continue; // Skip to next site if we can't delete from database
            }
            
            // Log overall status for this site
            if ($serverDeleteSuccess && $dnsDeleteSuccess && $databaseDeleteSuccess) {
                $this->info("Site {$site->name} completely deleted from all systems.");
            } else {
                $this->warn("Site {$site->name} deleted from database but with issues: " . implode(' ', $warnings));
            }
        }
        
        if ($count > 0) {
            $this->info("Successfully deleted {$count} expired sites.");
        } else {
            $this->info("No sites were deleted.");
        }
        
        return 0;
    }
}