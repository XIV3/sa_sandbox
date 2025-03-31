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
        // Skip all database operations if we're migrating
        if (getenv('APP_MIGRATING') === 'true') {
            return;
        }

        $this->configureMailFromDatabase();
    }

    /**
     * Configure mail settings from database
     */
    private function configureMailFromDatabase(): void
    {
        try {
            if (!Schema::hasTable('system_settings')) {
                return;
            }
            
            $mailSettings = SystemSetting::whereIn('meta_key', [
                'mail_host', 'mail_port', 'mail_username', 'mail_password',
                'mail_from_name', 'mail_from_address', 'mail_encryption'
            ])->pluck('meta_value', 'meta_key')->toArray();

            if (empty($mailSettings['mail_host']) || empty($mailSettings['mail_port'])) {
                return;
            }
                
            Config::set('mail.default', 'smtp');
            Config::set('mail.mailers.smtp.host', $mailSettings['mail_host']);
            Config::set('mail.mailers.smtp.port', $mailSettings['mail_port']);
            
            if (!empty($mailSettings['mail_username'])) {
                Config::set('mail.mailers.smtp.username', $mailSettings['mail_username']);
            }
            
            if (!empty($mailSettings['mail_password'])) {
                Config::set('mail.mailers.smtp.password', $mailSettings['mail_password']);
            }
            
            // Set encryption (tls or null)
            $encryption = !empty($mailSettings['mail_encryption']) && $mailSettings['mail_encryption'] == '1' ? 'tls' : null;
            Config::set('mail.mailers.smtp.encryption', $encryption);
            
            if (!empty($mailSettings['mail_from_address'])) {
                Config::set('mail.from.address', $mailSettings['mail_from_address']);
            }
            
            if (!empty($mailSettings['mail_from_name'])) {
                Config::set('mail.from.name', $mailSettings['mail_from_name']);
            }
        } catch (\Exception $e) {
            // Silent fail during deployment
        }
    }
}
