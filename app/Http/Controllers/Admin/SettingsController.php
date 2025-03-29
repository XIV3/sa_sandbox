<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
    
    /**
     * Send a test email using the configured SMTP settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function testEmail(Request $request)
    {
        // Get all mail settings
        $mailSettings = SystemSetting::whereIn('meta_key', [
            'mail_host', 'mail_port', 'mail_username', 'mail_password',
            'mail_from_name', 'mail_from_address', 'mail_encryption'
        ])->pluck('meta_value', 'meta_key')->toArray();
        
        // Check if all required settings are available
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
            // Manually configure mail settings for this request
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
            
            // Send test email to the authenticated user
            $user = $request->user();
            
            // Create a detailed test email message
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
}
