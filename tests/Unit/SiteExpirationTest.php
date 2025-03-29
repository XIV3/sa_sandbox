<?php

namespace Tests\Unit;

use App\Models\Site;
use App\Models\SystemSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteExpirationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the Site model automatically sets the expires_at field when creating a new site.
     */
    public function test_site_model_sets_expires_at_based_on_system_settings(): void
    {
        // Create a test system setting for default_deletion_time
        SystemSetting::updateOrCreate(
            ['meta_key' => 'default_deletion_time'],
            ['meta_value' => '24'] // 24 hours
        );
        
        // Create a selected server first (to satisfy foreign key constraints)
        $server = \App\Models\SelectedServer::create([
            'name' => 'Test Server',
            'server_id' => 123, // Must be an integer
            'ip_address' => '192.168.1.1',
            'connection_status' => 'connected',
        ]);

        // Create a new site without setting expires_at
        $site = Site::create([
            'name' => 'Test Site',
            'domain' => 'test.example.com',
            'status' => 'active',
            'selected_server_id' => $server->id,
            'server_id' => 'server-123',
            'site_data' => ['test' => true],
        ]);

        // Check that expires_at was set and is approximately 24 hours from now
        $this->assertNotNull($site->expires_at);
        
        // Allow 5 second tolerance for test execution
        $difference = now()->addHours(24)->diffInSeconds($site->expires_at, false);
        $this->assertLessThanOrEqual(5, abs($difference), 'Expiration time should be 24 hours from now.');
    }
}
