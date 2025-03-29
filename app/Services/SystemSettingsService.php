<?php

namespace App\Services;

use App\Models\SystemSetting;
use Illuminate\Support\Facades\Cache;

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
        // Try to get from cache first
        return Cache::remember('system_setting_' . $key, 3600, function () use ($key, $default) {
            $setting = SystemSetting::where('meta_key', $key)->first();
            return $setting ? $setting->meta_value : $default;
        });
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
        $setting = SystemSetting::where('meta_key', 'domain')->first();
        $domain = $setting ? $setting->meta_value : 'example.com';
        
        \Illuminate\Support\Facades\Log::debug('Getting uncached domain from system settings', [
            'raw_domain' => $domain,
            'using_fallback' => empty($setting),
            'returning' => $domain
        ]);
        
        return $domain;
    }
}