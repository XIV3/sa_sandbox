<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all settings from the database
        $settings = SystemSetting::pluck('meta_value', 'meta_key')->toArray();
        
        // Determine configuration status for each section
        $cloudflareConfigured = 
            isset($settings['zone_id']) && !empty($settings['zone_id']) &&
            isset($settings['cloudflare_api_key']) && !empty($settings['cloudflare_api_key']) &&
            isset($settings['domain']) && !empty($settings['domain']) &&
            isset($settings['ssl_certificate']) && !empty($settings['ssl_certificate']) &&
            isset($settings['private_key']) && !empty($settings['private_key']);
            
        $serveravatarConfigured = 
            isset($settings['api_url']) && !empty($settings['api_url']) &&
            isset($settings['api_key']) && !empty($settings['api_key']) &&
            isset($settings['organisation_id']) && !empty($settings['organisation_id']);
            
        $smtpConfigured = 
            isset($settings['mail_host']) && !empty($settings['mail_host']) &&
            isset($settings['mail_port']) && !empty($settings['mail_port']) &&
            isset($settings['mail_username']) && !empty($settings['mail_username']) &&
            isset($settings['mail_password']) && !empty($settings['mail_password']) &&
            isset($settings['mail_from_name']) && !empty($settings['mail_from_name']) &&
            isset($settings['mail_from_address']) && !empty($settings['mail_from_address']);
        
        return view('admin.settings.index', compact('settings', 'cloudflareConfigured', 'serveravatarConfigured', 'smtpConfigured'));
    }

    /**
     * Update the system settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $settings = $request->input('settings', []);
        
        // Define checkbox settings that need special handling
        $checkboxSettings = ['allow_site_creation', 'mail_encryption'];
        
        // First, handle all non-checkbox settings
        foreach ($settings as $key => $value) {
            if (!in_array($key, $checkboxSettings)) {
                SystemSetting::updateOrCreate(
                    ['meta_key' => $key],
                    ['meta_value' => $value]
                );
            }
        }
        
        // Then handle all checkbox settings (they may or may not be in the request)
        foreach ($checkboxSettings as $checkboxKey) {
            $value = isset($settings[$checkboxKey]) ? '1' : '0';
            
            SystemSetting::updateOrCreate(
                ['meta_key' => $checkboxKey],
                ['meta_value' => $value]
            );
        }
        
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }
}
