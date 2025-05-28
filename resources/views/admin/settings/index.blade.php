<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('System Settings') }}
        </h2>
        <p class="mt-1 text-gray-600 text-sm">
            Configure global system preferences and settings
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <!-- General Settings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">General Settings</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Configured</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Configure general system settings and default behaviors.</p>
                    
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="default_deletion_time" class="block text-sm font-medium text-gray-700 mb-1">Default Site Deletion Time</label>
                                    <select id="default_deletion_time" name="settings[default_deletion_time]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="1" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '1' ? 'selected' : '' }}>1 hour</option>
                                        <option value="6" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '6' ? 'selected' : '' }}>6 hours</option>
                                        <option value="12" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '12' ? 'selected' : '' }}>12 hours</option>
                                        <option value="24" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '24' ? 'selected' : '' }}>24 hours</option>
                                        <option value="168" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '168' ? 'selected' : '' }}>1 week</option>
                                        <option value="720" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '720' ? 'selected' : '' }}>1 month</option>
                                        <option value="2160" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '2160' ? 'selected' : '' }}>3 months</option>
                                        <option value="4380" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '4380' ? 'selected' : '' }}>6 months</option>
                                        <option value="8760" {{ isset($settings['default_deletion_time']) && $settings['default_deletion_time'] == '8760' ? 'selected' : '' }}>1 year</option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Set the default time period after which inactive sites will be automatically deleted</p>
                                </div>
                            </div>
                            
                            <div class="mt-6 space-y-4">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="allow_site_creation" name="settings[allow_site_creation]" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ isset($settings['allow_site_creation']) && $settings['allow_site_creation'] == '1' ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="allow_site_creation" class="font-medium text-gray-700">Allow site creation from homepage</label>
                                        <p class="text-gray-500">When enabled, users can create new sites directly from the homepage of the project</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="allow_registration" name="settings[allow_registration]" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ isset($settings['allow_registration']) && $settings['allow_registration'] == '1' ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="allow_registration" class="font-medium text-gray-700">Allow new user registrations</label>
                                        <p class="text-gray-500">When enabled, new users can register accounts on the site. If disabled, only existing users can log in.</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end mt-6">
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Cloudflare Integration Settings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">Cloudflare Integration</h3>
                        @if($cloudflareConfigured ?? false)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Configured</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Not Configured</span>
                        @endif
                    </div>
                    
                    <p class="text-gray-600 mb-4">Connect your domain with Cloudflare to enable automatic DNS management, SSL certificates, and advanced security features.</p>
                    
                    <!-- SSL/TLS Encryption Info -->
                    <div class="mb-4 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-yellow-800">Important SSL/TLS Configuration</h3>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p>For proper SSL functionality, please set your SSL/TLS encryption mode to <strong>"Full (strict)"</strong> in your Cloudflare dashboard under SSL/TLS settings.</p>
                                    <p class="mt-2"><strong>Warning:</strong> Site creation may fail if SSL/TLS settings are set lower than "Full (strict)". Improper SSL settings can lead to connection errors during site deployment.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="zone_id" class="block text-sm font-medium text-gray-700 mb-1">Zone ID</label>
                                    <input type="text" name="settings[zone_id]" id="zone_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="a1b2c3d4e5f6g7h8i9j0" value="{{ $settings['zone_id'] ?? '' }}">
                                    <p class="mt-1 text-xs text-gray-500">Find your Zone ID in the Cloudflare dashboard under "Overview" tab</p>
                                </div>
                                
                                <div>
                                    <label for="cloudflare_api_key" class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
                                    <input type="password" name="settings[cloudflare_api_key]" id="cloudflare_api_key" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="••••••••••••••••" value="{{ $settings['cloudflare_api_key'] ?? '' }}">
                                </div>
                            </div>
                            
                            <div>
                                <label for="domain" class="block text-sm font-medium text-gray-700 mb-1">Domain Name</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">https://</span>
                                    <input type="text" name="settings[domain]" id="domain" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="example.com" value="{{ $settings['domain'] ?? '' }}">
                                </div>
                            </div>
                            
                            <!-- Origin Certificate Section -->
                            <div class="bg-gray-50 p-5 rounded-md">
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Origin Certificate</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label for="ssl_certificate" class="block text-sm font-medium text-gray-700 mb-1">SSL Certificate</label>
                                        <textarea id="ssl_certificate" name="settings[ssl_certificate]" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="-----BEGIN CERTIFICATE-----">{{ $settings['ssl_certificate'] ?? '' }}</textarea>
                                        <p class="mt-1 text-xs text-gray-500">Paste your SSL certificate including the BEGIN and END tags</p>
                                    </div>
                                    
                                    <div>
                                        <label for="private_key" class="block text-sm font-medium text-gray-700 mb-1">Private Key</label>
                                        <textarea id="private_key" name="settings[private_key]" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="-----BEGIN PRIVATE KEY-----">{{ $settings['private_key'] ?? '' }}</textarea>
                                        <p class="mt-1 text-xs text-gray-500">Paste your private key including the BEGIN and END tags</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="button" id="testCloudflareApiBtn" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mr-3">
                                    Test Connection
                                </button>
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Save Settings
                                </button>
                            </div>
                            
                            <!-- Test Cloudflare connection status message -->
                            <div id="testCloudflareApiStatus" class="mt-3 hidden"></div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ServerAvatar API Settings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">ServerAvatar API Configuration</h3>
                        @if($serveravatarConfigured ?? false)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Configured</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Not Configured</span>
                        @endif
                    </div>
                    
                    <p class="text-gray-600 mb-4">Connect to your ServerAvatar account by providing API keys to enable server management functionality.</p>
                    
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="api_url" class="block text-sm font-medium text-gray-700 mb-1">ServerAvatar API URL</label>
                                    <input type="url" name="settings[api_url]" id="api_url" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://api.serveravatar.com" value="{{ $settings['api_url'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label for="api_key" class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
                                    <input type="password" name="settings[api_key]" id="api_key" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="••••••••••••••••" value="{{ $settings['api_key'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label for="organisation_id" class="block text-sm font-medium text-gray-700 mb-1">Organisation ID</label>
                                    <input type="number" name="settings[organisation_id]" id="organisation_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="12345" value="{{ $settings['organisation_id'] ?? '' }}">
                                    <p class="mt-1 text-xs text-gray-500">Enter your numeric ServerAvatar organisation ID</p>
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="button" id="testServerAvatarApiBtn" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mr-3">
                                    Test Connection
                                </button>
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Save Settings
                                </button>
                            </div>
                            
                            <!-- Test connection status message -->
                            <div id="testServerAvatarApiStatus" class="mt-3 hidden"></div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- SMTP Configuration Settings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">SMTP Configuration</h3>
                        @if(isset($smtpConfigured) && $smtpConfigured)
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Configured</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Not Configured</span>
                        @endif
                    </div>
                    
                    <p class="text-gray-600 mb-4">Configure email settings to enable notifications, password resets, and system alerts.</p>
                    
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="mail_host" class="block text-sm font-medium text-gray-700 mb-1">SMTP Host</label>
                                    <input type="text" name="settings[mail_host]" id="mail_host" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="smtp.example.com" value="{{ $settings['mail_host'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label for="mail_port" class="block text-sm font-medium text-gray-700 mb-1">SMTP Port</label>
                                    <input type="text" name="settings[mail_port]" id="mail_port" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="587" value="{{ $settings['mail_port'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label for="mail_username" class="block text-sm font-medium text-gray-700 mb-1">SMTP Username</label>
                                    <input type="text" name="settings[mail_username]" id="mail_username" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="your@email.com" value="{{ $settings['mail_username'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label for="mail_password" class="block text-sm font-medium text-gray-700 mb-1">SMTP Password</label>
                                    <input type="password" name="settings[mail_password]" id="mail_password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="••••••••••••••••" value="{{ $settings['mail_password'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label for="mail_from_name" class="block text-sm font-medium text-gray-700 mb-1">From Name</label>
                                    <input type="text" name="settings[mail_from_name]" id="mail_from_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Sandbox Notification" value="{{ $settings['mail_from_name'] ?? '' }}">
                                </div>
                                
                                <div>
                                    <label for="mail_from_address" class="block text-sm font-medium text-gray-700 mb-1">From Email</label>
                                    <input type="email" name="settings[mail_from_address]" id="mail_from_address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="no-reply@yourdomain.com" value="{{ $settings['mail_from_address'] ?? '' }}">
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-md">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="mail_encryption" name="settings[mail_encryption]" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" {{ isset($settings['mail_encryption']) && $settings['mail_encryption'] == '1' ? 'checked' : '' }}>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="mail_encryption" class="font-medium text-gray-700">Use TLS Encryption</label>
                                        <p class="text-gray-500">Enable TLS encryption for secure email transmission</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end space-x-4">
                                <button type="button" id="testEmailBtn" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Send Test Email
                                </button>
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Save Settings
                                </button>
                            </div>
                            
                            <!-- Test email status message -->
                            <div id="testEmailStatus" class="mt-3 hidden"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- AJAX Scripts for Test Email and ServerAvatar API Connection -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Test Email functionality
            const testEmailBtn = document.getElementById('testEmailBtn');
            const testEmailStatus = document.getElementById('testEmailStatus');
            
            if (testEmailBtn) {
                testEmailBtn.addEventListener('click', function() {
                    // Show loading state
                    testEmailBtn.disabled = true;
                    testEmailBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending...';
                    
                    // Display status container
                    testEmailStatus.classList.remove('hidden');
                    testEmailStatus.innerHTML = '<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-3" role="alert"><p>Sending test email, please wait...</p></div>';
                    
                    // Create form data with CSRF token
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    
                    // Send AJAX request
                    fetch('{{ route("admin.settings.test-email") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        testEmailBtn.disabled = false;
                        testEmailBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> Send Test Email';
                        
                        // Display success or error message
                        if (data.success) {
                            testEmailStatus.innerHTML = '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3" role="alert"><p>' + data.message + '</p></div>';
                        } else {
                            testEmailStatus.innerHTML = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3" role="alert"><p>' + data.message + '</p></div>';
                        }
                        
                        // Auto-hide message after 10 seconds
                        setTimeout(() => {
                            testEmailStatus.classList.add('hidden');
                        }, 10000);
                    })
                    .catch(error => {
                        // Reset button state
                        testEmailBtn.disabled = false;
                        testEmailBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg> Send Test Email';
                        
                        // Display error message
                        testEmailStatus.innerHTML = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3" role="alert"><p>An error occurred while sending the test email.</p></div>';
                    });
                });
            }
            
            // ServerAvatar API Test Connection functionality
            const testServerAvatarApiBtn = document.getElementById('testServerAvatarApiBtn');
            const testServerAvatarApiStatus = document.getElementById('testServerAvatarApiStatus');
            
            if (testServerAvatarApiBtn) {
                testServerAvatarApiBtn.addEventListener('click', function() {
                    // Show loading state
                    testServerAvatarApiBtn.disabled = true;
                    testServerAvatarApiBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Testing connection...';
                    
                    // Display status container
                    testServerAvatarApiStatus.classList.remove('hidden');
                    testServerAvatarApiStatus.innerHTML = '<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-3" role="alert"><p>Testing ServerAvatar API connection, please wait...</p></div>';
                    
                    // Create form data with CSRF token
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    
                    // Send AJAX request
                    fetch('{{ route("admin.settings.test-serveravatar-api") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        testServerAvatarApiBtn.disabled = false;
                        testServerAvatarApiBtn.innerHTML = 'Test Connection';
                        
                        // Display success or error message
                        if (data.success) {
                            testServerAvatarApiStatus.innerHTML = '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3" role="alert"><p>' + data.message + '</p></div>';
                        } else {
                            testServerAvatarApiStatus.innerHTML = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3" role="alert"><p>' + data.message + '</p></div>';
                        }
                        
                        // Auto-hide message after 10 seconds
                        setTimeout(() => {
                            testServerAvatarApiStatus.classList.add('hidden');
                        }, 10000);
                    })
                    .catch(error => {
                        // Reset button state
                        testServerAvatarApiBtn.disabled = false;
                        testServerAvatarApiBtn.innerHTML = 'Test Connection';
                        
                        // Display error message
                        testServerAvatarApiStatus.innerHTML = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3" role="alert"><p>An error occurred while testing the API connection.</p></div>';
                    });
                });
            }
            
            // Cloudflare API Test Connection functionality
            const testCloudflareApiBtn = document.getElementById('testCloudflareApiBtn');
            const testCloudflareApiStatus = document.getElementById('testCloudflareApiStatus');
            
            if (testCloudflareApiBtn) {
                testCloudflareApiBtn.addEventListener('click', function() {
                    // Show loading state
                    testCloudflareApiBtn.disabled = true;
                    testCloudflareApiBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Testing connection...';
                    
                    // Display status container
                    testCloudflareApiStatus.classList.remove('hidden');
                    testCloudflareApiStatus.innerHTML = '<div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-3" role="alert"><p>Testing Cloudflare API connection, please wait...</p></div>';
                    
                    // Create form data with CSRF token
                    const formData = new FormData();
                    formData.append('_token', '{{ csrf_token() }}');
                    
                    // Send AJAX request
                    fetch('{{ route("admin.settings.test-cloudflare-api") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'Accept': 'application/json'
                        },
                        credentials: 'same-origin'
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Reset button state
                        testCloudflareApiBtn.disabled = false;
                        testCloudflareApiBtn.innerHTML = 'Test Connection';
                        
                        // Display success or error message
                        if (data.success) {
                            let message = data.message;
                            
                            // If we have nameservers data, add it to the message
                            if (data.data && data.data.name_servers && data.data.name_servers.length > 0) {
                                message += '<br><span class="text-xs mt-1 block">Name servers: ' + data.data.name_servers.join(', ') + '</span>';
                            }
                            
                            testCloudflareApiStatus.innerHTML = '<div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3" role="alert"><p>' + message + '</p></div>';
                        } else {
                            testCloudflareApiStatus.innerHTML = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3" role="alert"><p>' + data.message + '</p></div>';
                        }
                        
                        // Auto-hide message after 10 seconds
                        setTimeout(() => {
                            testCloudflareApiStatus.classList.add('hidden');
                        }, 10000);
                    })
                    .catch(error => {
                        // Reset button state
                        testCloudflareApiBtn.disabled = false;
                        testCloudflareApiBtn.innerHTML = 'Test Connection';
                        
                        // Display error message
                        testCloudflareApiStatus.innerHTML = '<div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3" role="alert"><p>An error occurred while testing the Cloudflare API connection.</p></div>';
                    });
                });
            }
        });
    </script>
</x-app-layout>
