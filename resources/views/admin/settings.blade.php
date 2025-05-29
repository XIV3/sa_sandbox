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
            <!-- General Settings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">General Settings</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">Configured</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Configure general system settings and default behaviors.</p>
                    
                    <form>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="default_deletion_time" class="block text-sm font-medium text-gray-700 mb-1">Default Site Deletion Time</label>
                                    <select id="default_deletion_time" name="default_deletion_time" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                        <option value="1">1 hour</option>
                                        <option value="6">6 hours</option>
                                        <option value="12">12 hours</option>
                                        <option value="24">24 hours</option>
                                        <option value="168">1 week</option>
                                        <option value="720">1 month</option>
                                        <option value="0">Indefinite</option>
                                    </select>
                                    <p class="mt-1 text-xs text-gray-500">Set the default time period after which inactive sites will be automatically deleted</p>
                                </div>
                            </div>
                            
                            <div class="mt-6">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="allow_site_creation" name="allow_site_creation" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="allow_site_creation" class="font-medium text-gray-700">Allow site creation from homepage</label>
                                        <p class="text-gray-500">When enabled, users can create new sites directly from the homepage of the project</p>
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
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Not Configured</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Connect your domain with Cloudflare to enable automatic DNS management, SSL certificates, and advanced security features.</p>
                    
                    <form>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="zone_id" class="block text-sm font-medium text-gray-700 mb-1">Zone ID</label>
                                    <input type="text" name="zone_id" id="zone_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="a1b2c3d4e5f6g7h8i9j0">
                                    <p class="mt-1 text-xs text-gray-500">Find your Zone ID in the Cloudflare dashboard under "Overview" tab</p>
                                </div>
                                
                                <div>
                                    <label for="cloudflare_api_key" class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
                                    <input type="password" name="cloudflare_api_key" id="cloudflare_api_key" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="••••••••••••••••">
                                </div>
                            </div>
                            
                            <div>
                                <label for="domain" class="block text-sm font-medium text-gray-700 mb-1">Domain Name</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">https://</span>
                                    <input type="text" name="domain" id="domain" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="example.com">
                                </div>
                            </div>
                            
                            <!-- Origin Certificate Section -->
                            <div class="bg-gray-50 p-5 rounded-md">
                                <h4 class="text-sm font-medium text-gray-900 mb-3">Origin Certificate</h4>
                                <div class="space-y-4">
                                    <div>
                                        <label for="ssl_certificate" class="block text-sm font-medium text-gray-700 mb-1">SSL Certificate</label>
                                        <textarea id="ssl_certificate" name="ssl_certificate" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="-----BEGIN CERTIFICATE-----"></textarea>
                                        <p class="mt-1 text-xs text-gray-500">Paste your SSL certificate including the BEGIN and END tags</p>
                                    </div>
                                    
                                    <div>
                                        <label for="private_key" class="block text-sm font-medium text-gray-700 mb-1">Private Key</label>
                                        <textarea id="private_key" name="private_key" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="-----BEGIN PRIVATE KEY-----"></textarea>
                                        <p class="mt-1 text-xs text-gray-500">Paste your private key including the BEGIN and END tags</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="button" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mr-3">
                                    Test Connection
                                </button>
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ServerAvatar API Settings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">ServerAvatar API Configuration</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Not Configured</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Connect to your ServerAvatar account by providing API keys to enable server management functionality.</p>
                    
                    <form>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="api_url" class="block text-sm font-medium text-gray-700 mb-1">ServerAvatar API URL</label>
                                    <input type="url" name="api_url" id="api_url" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://api.serveravatar.com/v1">
                                </div>
                                
                                <div>
                                    <label for="api_key" class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
                                    <input type="password" name="api_key" id="api_key" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="••••••••••••••••">
                                </div>
                                
                                <div>
                                    <label for="organisation_id" class="block text-sm font-medium text-gray-700 mb-1">Organisation ID</label>
                                    <input type="number" name="organisation_id" id="organisation_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="12345">
                                    <p class="mt-1 text-xs text-gray-500">Enter your numeric ServerAvatar organisation ID</p>
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-md">
                                <h4 class="text-sm font-medium text-gray-900">API Permissions</h4>
                                <p class="text-xs text-gray-500 mb-3">The API key requires the following permissions to function properly:</p>
                                <ul class="space-y-2 text-sm text-gray-600">
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Server Management - Read/Write
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        DNS Management - Read/Write
                                    </li>
                                    <li class="flex items-center">
                                        <svg class="h-4 w-4 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                        Application Management - Read/Write
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="button" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mr-3">
                                    Test Connection
                                </button>
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- SMTP Configuration Settings -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-lg font-medium text-gray-900">SMTP Configuration</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Not Configured</span>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Configure email settings to enable notifications, password resets, and system alerts.</p>
                    
                    <form>
                        <div class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="mail_host" class="block text-sm font-medium text-gray-700 mb-1">SMTP Host</label>
                                    <input type="text" name="mail_host" id="mail_host" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="smtp.example.com">
                                </div>
                                
                                <div>
                                    <label for="mail_port" class="block text-sm font-medium text-gray-700 mb-1">SMTP Port</label>
                                    <input type="text" name="mail_port" id="mail_port" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="587">
                                </div>
                                
                                <div>
                                    <label for="mail_username" class="block text-sm font-medium text-gray-700 mb-1">SMTP Username</label>
                                    <input type="text" name="mail_username" id="mail_username" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="your@email.com">
                                </div>
                                
                                <div>
                                    <label for="mail_password" class="block text-sm font-medium text-gray-700 mb-1">SMTP Password</label>
                                    <input type="password" name="mail_password" id="mail_password" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="••••••••••••••••">
                                </div>
                                
                                <div>
                                    <label for="mail_from_name" class="block text-sm font-medium text-gray-700 mb-1">From Name</label>
                                    <input type="text" name="mail_from_name" id="mail_from_name" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Sandbox Notification">
                                </div>
                                
                                <div>
                                    <label for="mail_from_address" class="block text-sm font-medium text-gray-700 mb-1">From Email</label>
                                    <input type="email" name="mail_from_address" id="mail_from_address" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="no-reply@yourdomain.com">
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 p-4 rounded-md">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="mail_encryption" name="mail_encryption" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" checked>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="mail_encryption" class="font-medium text-gray-700">Use TLS Encryption</label>
                                        <p class="text-gray-500">Enable TLS encryption for secure email transmission</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="button" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 mr-3">
                                    Send Test Email
                                </button>
                                <button type="submit" class="inline-flex items-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    Save Settings
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
