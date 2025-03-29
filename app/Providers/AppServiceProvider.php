<?php

namespace App\Providers;

use App\Models\SystemSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register the SystemSettingsService as a singleton
        $this->app->singleton(\App\Services\SystemSettingsService::class);
        
        // Register a short alias for the service
        $this->app->alias(\App\Services\SystemSettingsService::class, 'system-settings');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Check if the system_settings table exists
        if (Schema::hasTable('system_settings')) {
            // Get all mail settings from the database
            $mailSettings = SystemSetting::whereIn('meta_key', [
                'mail_host', 'mail_port', 'mail_username', 'mail_password',
                'mail_from_name', 'mail_from_address', 'mail_encryption'
            ])->pluck('meta_value', 'meta_key')->toArray();

            // Only apply settings if we have all the required ones
            if (isset($mailSettings['mail_host']) && !empty($mailSettings['mail_host']) &&
                isset($mailSettings['mail_port']) && !empty($mailSettings['mail_port'])) {
                
                // Configure the mail settings
                Config::set('mail.default', 'smtp');
                Config::set('mail.mailers.smtp.host', $mailSettings['mail_host']);
                Config::set('mail.mailers.smtp.port', $mailSettings['mail_port']);
                
                if (isset($mailSettings['mail_username']) && !empty($mailSettings['mail_username'])) {
                    Config::set('mail.mailers.smtp.username', $mailSettings['mail_username']);
                }
                
                if (isset($mailSettings['mail_password']) && !empty($mailSettings['mail_password'])) {
                    Config::set('mail.mailers.smtp.password', $mailSettings['mail_password']);
                }
                
                // Set encryption based on the mail_encryption setting
                $encryption = (isset($mailSettings['mail_encryption']) && $mailSettings['mail_encryption'] == '1') ? 'tls' : null;
                Config::set('mail.mailers.smtp.encryption', $encryption);
                
                // Set the from address and name
                if (isset($mailSettings['mail_from_address']) && !empty($mailSettings['mail_from_address'])) {
                    Config::set('mail.from.address', $mailSettings['mail_from_address']);
                }
                
                if (isset($mailSettings['mail_from_name']) && !empty($mailSettings['mail_from_name'])) {
                    Config::set('mail.from.name', $mailSettings['mail_from_name']);
                }
            }
        }
    }
}
