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
        Cache::forget('system_setting_' . $key);
    }
}