<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = SystemSetting::pluck('meta_value', 'meta_key')->toArray();
        
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

    public function update(Request $request)
    {
        $settings = $request->input('settings', []);
        
        $checkboxSettings = ['allow_permanent_sites','allow_site_creation', 'allow_registration', 'mail_encryption'];
        
        $systemSettingsService = app(\App\Services\SystemSettingsService::class);
        
        foreach ($settings as $key => $value) {
            if (!in_array($key, $checkboxSettings)) {
                SystemSetting::updateOrCreate(
                    ['meta_key' => $key],
                    ['meta_value' => $value]
                );
                
                $systemSettingsService->clearCache($key);
                
                if ($key === 'domain') {
                    \Illuminate\Support\Facades\Log::info('Domain setting updated', [
                        'new_value' => $value,
                        'cache_cleared' => true
                    ]);
                }
            }
        }
        
        foreach ($checkboxSettings as $checkboxKey) {
            $value = isset($settings[$checkboxKey]) ? '1' : '0';
            
            SystemSetting::updateOrCreate(
                ['meta_key' => $checkboxKey],
                ['meta_value' => $value]
            );
            
            $systemSettingsService->clearCache($checkboxKey);
        }
        
        $systemSettingsService->clearCache('domain');
        
        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully');
    }
    
    public function testEmail(Request $request)
    {
        $mailSettings = SystemSetting::whereIn('meta_key', [
            'mail_host', 'mail_port', 'mail_username', 'mail_password',
            'mail_from_name', 'mail_from_address', 'mail_encryption'
        ])->pluck('meta_value', 'meta_key')->toArray();
        
        $requiredSettings = ['mail_host', 'mail_port', 'mail_username', 'mail_password', 'mail_from_name', 'mail_from_address'];
        foreach ($requiredSettings as $setting) {
            if (!isset($mailSettings[$setting]) || empty($mailSettings[$setting])) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Please complete all SMTP configuration fields before sending a test email.'
                    ]);
                }
                
                return redirect()->route('admin.settings.index')
                    ->with('error', 'Please complete all SMTP configuration fields before sending a test email.');
            }
        }
        
        try {
            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => $mailSettings['mail_host'],
                'mail.mailers.smtp.port' => $mailSettings['mail_port'],
                'mail.mailers.smtp.username' => $mailSettings['mail_username'],
                'mail.mailers.smtp.password' => $mailSettings['mail_password'],
                'mail.mailers.smtp.encryption' => isset($mailSettings['mail_encryption']) && $mailSettings['mail_encryption'] == '1' ? 'tls' : null,
                'mail.from.address' => $mailSettings['mail_from_address'],
                'mail.from.name' => $mailSettings['mail_from_name'],
            ]);
            
            $user = $request->user();
            
            $message = "This is a test email from your application to verify that your SMTP settings are correctly configured.\n\n";
            $message .= "SMTP Configuration:\n";
            $message .= "- Host: " . $mailSettings['mail_host'] . "\n";
            $message .= "- Port: " . $mailSettings['mail_port'] . "\n";
            $message .= "- Encryption: " . (isset($mailSettings['mail_encryption']) && $mailSettings['mail_encryption'] == '1' ? 'TLS' : 'None') . "\n";
            $message .= "- From: " . $mailSettings['mail_from_name'] . " <" . $mailSettings['mail_from_address'] . ">\n\n";
            $message .= "If you received this email, your SMTP configuration is working properly!";
            
            Mail::raw($message, function ($mail) use ($user, $mailSettings) {
                $mail->to($user->email);
                $mail->subject('SMTP Configuration Test');
            });
            
            $successMessage = 'Test email sent successfully! Please check your inbox at ' . $user->email;
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $successMessage
                ]);
            }
            
            return redirect()->route('admin.settings.index')->with('success', $successMessage);
            
        } catch (\Exception $e) {
            $errorMessage = 'Failed to send test email: ' . $e->getMessage();
            
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ]);
            }
            
            return redirect()->route('admin.settings.index')->with('error', $errorMessage);
        }
    }
    
    public function testServerAvatarApi(Request $request)
    {
        $apiSettings = SystemSetting::whereIn('meta_key', [
            'api_url', 'api_key', 'organisation_id'
        ])->pluck('meta_value', 'meta_key')->toArray();
        
        $requiredSettings = ['api_url', 'api_key', 'organisation_id'];
        foreach ($requiredSettings as $setting) {
            if (!isset($apiSettings[$setting]) || empty($apiSettings[$setting])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please complete all ServerAvatar API configuration fields before testing the connection.'
                ]);
            }
        }
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => $apiSettings['api_key']
            ])->get($apiSettings['api_url'] . '/organizations/' . $apiSettings['organisation_id']);
            
            if ($response->successful() && isset($response->json()['organization'])) {
                $org = $response->json()['organization'];
                
                return response()->json([
                    'success' => true,
                    'message' => 'Connection successful! Connected to organization: ' . $org['name'],
                    'data' => [
                        'organization_name' => $org['name'],
                        'organization_id' => $org['id']
                    ]
                ]);
            } else {
                $errorMessage = 'API connection failed. ';
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Organization not found. Please check your Organization ID.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    if (isset($response->json()['message'])) {
                        $errorMessage .= ' - ' . $response->json()['message'];
                    }
                }
                
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection failed: ' . $e->getMessage()
            ]);
        }
    }
    
    public function testCloudflareApi(Request $request)
    {
        $cloudflareSettings = SystemSetting::whereIn('meta_key', [
            'zone_id', 'cloudflare_api_key', 'domain'
        ])->pluck('meta_value', 'meta_key')->toArray();
        
        $requiredSettings = ['zone_id', 'cloudflare_api_key', 'domain'];
        foreach ($requiredSettings as $setting) {
            if (!isset($cloudflareSettings[$setting]) || empty($cloudflareSettings[$setting])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please complete all Cloudflare configuration fields before testing the connection.'
                ]);
            }
        }
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $cloudflareSettings['cloudflare_api_key']
            ])->get('https://api.cloudflare.com/client/v4/zones/' . $cloudflareSettings['zone_id']);
            
            if ($response->successful() && isset($response->json()['success']) && $response->json()['success'] === true) {
                $zoneData = $response->json()['result'];
                
                return response()->json([
                    'success' => true,
                    'message' => 'Cloudflare connection successful! Connected to zone: ' . $zoneData['name'],
                    'data' => [
                        'zone_name' => $zoneData['name'],
                        'zone_status' => $zoneData['status'],
                        'name_servers' => $zoneData['name_servers'] ?? []
                    ]
                ]);
            } else {
                $errorMessage = 'Cloudflare API connection failed. ';
                
                if ($response->status() === 401 || $response->status() === 403) {
                    $errorMessage .= 'Authentication failed. Please check your API key.';
                } elseif ($response->status() === 404) {
                    $errorMessage .= 'Zone not found. Please check your Zone ID.';
                } else {
                    $errorMessage .= 'Server returned status code: ' . $response->status();
                    
                    if (isset($response->json()['errors']) && !empty($response->json()['errors'])) {
                        $errorMessage .= ' - ' . $response->json()['errors'][0]['message'];
                    }
                }
                
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Connection failed: ' . $e->getMessage()
            ]);
        }
    }
}
