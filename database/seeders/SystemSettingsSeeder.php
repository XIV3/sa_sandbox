<?php

namespace Database\Seeders;

use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class SystemSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General Settings
        SystemSetting::updateOrCreate(
            ['meta_key' => 'default_deletion_time'],
            ['meta_value' => '24'] // Default to 24 hours
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'allow_permanent_sites'],
            ['meta_value' => '0'] // Default to disabled
        );
        
        SystemSetting::updateOrCreate(
            ['meta_key' => 'allow_site_creation'],
            ['meta_value' => '0'] // Default to disabled
        );
        
        SystemSetting::updateOrCreate(
            ['meta_key' => 'allow_registration'],
            ['meta_value' => '1'] // Default to enabled
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'subdomain_postfix'],
            ['meta_value' => '-wp'] // Additional characters to minimize duplicates
        );

        // Cloudflare Integration Settings
        SystemSetting::updateOrCreate(
            ['meta_key' => 'zone_id'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'cloudflare_api_key'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'domain'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'ssl_certificate'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'private_key'],
            ['meta_value' => '']
        );

        // ServerAvatar API Settings
        SystemSetting::updateOrCreate(
            ['meta_key' => 'api_url'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'api_key'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'organisation_id'],
            ['meta_value' => '']
        );

        // SMTP Configuration Settings
        SystemSetting::updateOrCreate(
            ['meta_key' => 'mail_host'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'mail_port'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'mail_username'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'mail_password'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'mail_from_name'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'mail_from_address'],
            ['meta_value' => '']
        );

        SystemSetting::updateOrCreate(
            ['meta_key' => 'mail_encryption'],
            ['meta_value' => '0'] // Default to disabled
        );
    }
}
