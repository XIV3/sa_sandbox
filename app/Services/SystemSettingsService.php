<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class SystemSettingsService
{
    /**
     * Get a system setting value by key
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        // Skip during migrations
        if (getenv('APP_MIGRATING') === 'true') {
            return $default;
        }

        // Skip if table doesn't exist
        if (!Schema::hasTable('system_settings')) {
            return $default;
        }

        try {
            return Cache::remember('system_setting_' . $key, 3600, function () use ($key, $default) {
                $setting = SystemSetting::where('meta_key', $key)->first();
                return $setting ? $setting->meta_value : $default;
            });
        } catch (\Exception $e) {
            return $default;
        }
    }

    /**
     * Get the domain name from system settings or return a default
     *
     * @return string
     */
    public function getDomain()
    {
        $domain = $this->get('domain');
        
        // Always log what domain we're returning
        \Illuminate\Support\Facades\Log::debug('Getting domain from system settings', [
            'raw_domain' => $domain,
            'using_fallback' => empty($domain),
            'returning' => !empty($domain) ? $domain : 'example.com'
        ]);
        
        return $domain && !empty($domain) ? $domain : 'example.com';
    }

    /**
     * Clear the cache for a specific setting
     *
     * @param string $key
     * @return void
     */
    public function clearCache(string $key)
    {
        $cacheKey = 'system_setting_' . $key;
        Cache::forget($cacheKey);
        
        // Log the cache clearing for debugging
        \Illuminate\Support\Facades\Log::debug('Cleared system setting cache', [
            'key' => $key,
            'cache_key' => $cacheKey,
        ]);
    }
    
    /**
     * Directly get the domain name from database, bypassing cache
     *
     * @return string
     */
    public function getUncachedDomain()
    {
        // Skip during migrations
        if (getenv('APP_MIGRATING') === 'true') {
            return 'example.com';
        }
        
        // Skip if table doesn't exist
        if (!Schema::hasTable('system_settings')) {
            return 'example.com';
        }
        
        try {
            $setting = SystemSetting::where('meta_key', 'domain')->first();
            return $setting ? $setting->meta_value : 'example.com';
        } catch (\Exception $e) {
            return 'example.com';
        }
    }
}