<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $site->domain }} - Site Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        :root {
            --primary-color: #4F46E5;
            --secondary-color: #6B7280;
            --accent-color: #EC4899;
        }
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">
    <header>
        <nav class="navbar navbar-expand-lg py-3 fixed-top bg-white bg-opacity-95">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <div class="d-flex flex-column">
                        <span class="fw-bold" style="color: var(--primary-color); line-height: 1.1; font-size: 2.2rem;">Sandbox</span>
                    </div>
                </a>
                <div class="d-flex align-items-center gap-3">
                    <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-4 py-2 d-flex align-items-center shadow-sm" 
                       style="background: linear-gradient(90deg, var(--primary-color), #6366F1); border: none; transition: all 0.3s ease;">
                        <i class="fas fa-rocket me-2"></i>
                        <span>Deploy Temp Site</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Spacer to compensate for fixed navbar -->
    <div class="pb-5 mb-4"></div>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Info Card -->
                <div class="col-span-1 lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-indigo-50">
                        <div class="p-6">
                            <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-4">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Site Information
                                </h3>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                                    {{ $site->status == 'active' ? 'bg-green-100 text-green-800' : 
                                    ($site->status == 'maintenance' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ ucfirst($site->status) }}
                                </span>
                            </div>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Site Name</div>
                                    <div class="mt-1 text-base text-gray-900">{{ $site->name }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Domain</div>
                                    <div class="mt-1 text-base text-gray-900">
                                        <a href="https://{{ $site->domain }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 hover:underline flex items-center">
                                            {{ $site->domain }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Server</div>
                                    <div class="mt-1 text-base text-gray-900">{{ $site->server->name ?? 'N/A' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Server ID</div>
                                    <div class="mt-1 text-base text-gray-900 font-mono text-sm">{{ $site->server_id }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Created At</div>
                                    <div class="mt-1 text-base text-gray-900">{{ $site->created_at->format('F j, Y g:i A e') }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Notification Email</div>
                                    <div class="mt-1 text-base text-gray-900">
                                        {{ $site->email ?? ($site->site_data['notification_email'] ?? 'None') }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Expires At</div>
                                    <div class="mt-1 text-base text-gray-900">
                                        {{ $site->expires_at ? $site->expires_at->format('F j, Y g:i A e') : 'N/A' }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Application ID</div>
                                    <div class="mt-1 text-base text-gray-900 font-mono text-sm">
                                        {{ $site->application_id ?? 'Not available' }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="text-sm font-medium text-gray-400">UUID</div>
                                    <div class="mt-1 text-sm text-gray-900 font-mono bg-gray-50 p-2 rounded break-all">
                                        {{ $site->uuid }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- DNS Record Information -->
                    @if($site->has_dns_record)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-indigo-50 mt-6">
                        <div class="p-6">
                            <div class="flex items-center border-b border-gray-100 pb-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">DNS Record</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-x-6 gap-y-4 sm:grid-cols-2">
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Record Type</div>
                                    <div class="mt-1 text-base text-gray-900">
                                        <span class="px-2 py-1 bg-purple-50 text-purple-700 rounded text-xs font-medium">A Record</span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Name</div>
                                    <div class="mt-1 text-base text-gray-900">{{ $site->domain }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Points to IP</div>
                                    <div class="mt-1 text-base text-gray-900 font-mono">
                                        {{ $site->server->ip_address ?? ($site->site_data['dns_record']['ip_address'] ?? 'Not available') }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Created</div>
                                    <div class="mt-1 text-base text-gray-900">
                                        {{ !empty($site->site_data['dns_record']['created_at']) ? \Carbon\Carbon::parse($site->site_data['dns_record']['created_at'])->format('F j, Y g:i A e') : 'Not available' }}
                                    </div>
                                </div>
                                @if(!empty($site->cloudflare_record_id))
                                <div class="sm:col-span-2">
                                    <div class="text-sm font-medium text-gray-400">Record ID</div>
                                    <div class="mt-1 text-sm text-gray-900 font-mono bg-gray-50 p-2 rounded break-all">
                                        {{ $site->cloudflare_record_id }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- PHP Information Section -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-indigo-50 mt-6">
                        <div class="p-6">
                            <div class="flex items-center border-b border-gray-100 pb-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                </svg>
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">PHP Settings</h3>
                            </div>

                            @if(isset($applicationDetails['application']))
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 mt-4">
                                    <!-- PHP Version -->
                                    <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg p-4 shadow-sm">
                                        <div class="text-sm font-medium text-gray-500 mb-1">PHP Version</div>
                                        <div class="text-lg font-semibold text-blue-700">
                                            {{ $applicationDetails['application']['php_version'] ?? $site->php_version ?? 'Not available' }}
                                        </div>
                                    </div>

                                    <!-- Memory Limit -->
                                    <div class="bg-gradient-to-r from-green-50 to-green-100 rounded-lg p-4 shadow-sm">
                                        <div class="text-sm font-medium text-gray-500 mb-1">Memory Limit</div>
                                        <div class="text-lg font-semibold text-green-700">
                                            {{ $applicationDetails['application']['memory_limit'] ?? 'Not available' }}
                                        </div>
                                    </div>

                                    <!-- Max Execution Time -->
                                    <div class="bg-gradient-to-r from-indigo-50 to-indigo-100 rounded-lg p-4 shadow-sm">
                                        <div class="text-sm font-medium text-gray-500 mb-1">Max Execution Time</div>
                                        <div class="text-lg font-semibold text-indigo-700">
                                            {{ $applicationDetails['application']['max_execution_time'] ?? 'Not available' }} seconds
                                        </div>
                                    </div>
                                    
                                    <!-- Max Input Time -->
                                    <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg p-4 shadow-sm">
                                        <div class="text-sm font-medium text-gray-500 mb-1">Max Input Time</div>
                                        <div class="text-lg font-semibold text-purple-700">
                                            {{ $applicationDetails['application']['max_input_time'] ?? 'Not available' }} seconds
                                        </div>
                                    </div>

                                    <!-- Upload Max Filesize -->
                                    <div class="bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg p-4 shadow-sm">
                                        <div class="text-sm font-medium text-gray-500 mb-1">Upload Max Filesize</div>
                                        <div class="text-lg font-semibold text-orange-700">
                                            {{ $applicationDetails['application']['upload_max_filesize'] ?? 'Not available' }}
                                        </div>
                                    </div>

                                    <!-- Post Max Size -->
                                    <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg p-4 shadow-sm">
                                        <div class="text-sm font-medium text-gray-500 mb-1">Post Max Size</div>
                                        <div class="text-lg font-semibold text-teal-700">
                                            {{ $applicationDetails['application']['post_max_size'] ?? 'Not available' }}
                                        </div>
                                    </div>

                                    <!-- Max Input Vars -->
                                    <div class="col-span-2 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-4 shadow-sm">
                                        <div class="text-sm font-medium text-gray-500 mb-1">Max Input Variables</div>
                                        <div class="text-lg font-semibold text-gray-700">
                                            {{ $applicationDetails['application']['max_input_vars'] ?? 'Not available' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-6 bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-blue-700">
                                                These PHP settings are fetched directly from the server. To modify these settings, you'll need to contact the server administrator.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-yellow-700">
                                                Unable to fetch PHP settings from the server. This could be due to connectivity issues or missing API credentials.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-8 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No PHP settings available</h3>
                                    <p class="mt-1 text-sm text-gray-500">
                                        PHP settings information could not be retrieved from the server at this time.
                                    </p>
                                    <div class="mt-6 bg-gray-50 p-4 rounded-lg shadow-inner">
                                        <p class="text-xs text-gray-600">
                                            This could be due to connectivity issues with the server or missing API credentials.
                                            Default PHP settings are being used according to the server configuration.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Credentials Sidebar -->
                <div class="col-span-1">
                    <!-- Auto-Delete Countdown -->
                    @if($site->expires_at)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-red-100 mb-6">
                        <div class="p-6">
                            <div class="flex items-center border-b border-gray-100 pb-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Auto-Delete Timer</h3>
                            </div>

                            <div class="mb-4">
                                @if($site->expires_at->isPast())
                                    <div class="bg-red-50 border-l-4 border-red-500 p-4">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-red-800">
                                                    This site has expired and is pending deletion
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div 
                                        x-data="{ 
                                            expiryTime: '{{ $site->expires_at->timestamp }}',
                                            now: Math.floor(Date.now() / 1000),
                                            countdown: '',
                                            updateCountdown() {
                                                this.now = Math.floor(Date.now() / 1000);
                                                let timeLeft = this.expiryTime - this.now;
                                                
                                                if (timeLeft <= 0) {
                                                    this.countdown = 'Expired';
                                                    return;
                                                }
                                                
                                                const days = Math.floor(timeLeft / 86400);
                                                timeLeft %= 86400;
                                                const hours = Math.floor(timeLeft / 3600);
                                                timeLeft %= 3600;
                                                const minutes = Math.floor(timeLeft / 60);
                                                const seconds = timeLeft % 60;
                                                
                                                let parts = [];
                                                if (days > 0) parts.push(`${days}d`);
                                                parts.push(`${hours}h`);
                                                parts.push(`${minutes}m`);
                                                parts.push(`${seconds}s`);
                                                
                                                this.countdown = parts.join(' ');
                                            }
                                        }"
                                        x-init="updateCountdown(); setInterval(() => { updateCountdown() }, 1000)"
                                    >
                                        <div class="text-center py-3 bg-yellow-50 rounded-lg">
                                            <div class="text-sm text-yellow-700 mb-1">This site will be deleted in:</div>
                                            <div class="text-2xl font-bold text-yellow-800" x-text="countdown"></div>
                                            <div class="text-xs text-yellow-600 mt-1">
                                                ({{ $site->expires_at->format('F j, Y g:i A e') }})
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 text-sm text-gray-600">
                                            <p>All site content and databases will be permanently removed after the timer expires.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- WordPress Admin -->
                    @if(!empty($site->site_data) && !empty($site->site_data['wp_username']))
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-indigo-50 mb-6">
                        <div class="p-6">
                            <div class="flex items-center border-b border-gray-100 pb-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">WordPress Admin</h3>
                            </div>

                            <div class="flex justify-between items-center mb-3">
                                <div class="text-sm font-medium text-gray-400">Admin URL</div>
                                <a href="https://{{ $site->domain }}/wp-admin" target="_blank" 
                                   class="text-sm text-white bg-indigo-600 hover:bg-indigo-700 px-2 py-1 rounded transition flex items-center">
                                    <span>Login</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </a>
                            </div>

                            <div class="mt-4">
                                <div class="text-sm font-medium text-gray-400">Username</div>
                                <div class="mt-1 flex items-center justify-between">
                                    <div class="font-mono text-sm bg-gray-50 px-3 py-2 rounded w-full">
                                        {{ $site->wp_username ?? $site->site_data['wp_username'] }}
                                    </div>
                                    <button onclick="copyToClipboard('{{ $site->wp_username ?? $site->site_data['wp_username'] }}')" 
                                            class="ml-2 text-gray-400 hover:text-gray-600 focus:outline-none" title="Copy to clipboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-4">
                                <div class="text-sm font-medium text-gray-400">Password</div>
                                <div class="mt-1 flex items-center justify-between">
                                    <div class="font-mono text-sm bg-gray-50 px-3 py-2 rounded w-full">
                                        {{ $site->site_data['wp_password'] ?? 'Not available' }}
                                    </div>
                                    <button onclick="copyToClipboard('{{ $site->site_data['wp_password'] ?? 'Not available' }}')" 
                                            class="ml-2 text-gray-400 hover:text-gray-600 focus:outline-none" title="Copy to clipboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Database Information -->
                    @if(!empty($site->database_id) || !empty($site->site_data['database_id']))
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-indigo-50">
                        <div class="p-6">
                            <div class="flex items-center border-b border-gray-100 pb-4 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                                </svg>
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Database</h3>
                            </div>

                            <div>
                                <div class="text-sm font-medium text-gray-400">Database Host</div>
                                <div class="mt-1 mb-4 font-mono text-sm bg-gray-50 px-3 py-2 rounded">
                                    {{ $site->database_host ?? $site->site_data['database_host'] ?? 'localhost' }}
                                </div>
                            </div>

                            <div>
                                <div class="text-sm font-medium text-gray-400">Database Name</div>
                                <div class="mt-1 mb-4 flex items-center justify-between">
                                    <div class="font-mono text-sm bg-gray-50 px-3 py-2 rounded w-full">
                                        {{ $site->database_name ?? $site->site_data['database_name'] ?? 'Not available' }}
                                    </div>
                                    <button onclick="copyToClipboard('{{ $site->database_name ?? $site->site_data['database_name'] ?? 'Not available' }}')" 
                                            class="ml-2 text-gray-400 hover:text-gray-600 focus:outline-none" title="Copy to clipboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <div class="text-sm font-medium text-gray-400">Database Username</div>
                                <div class="mt-1 mb-4 flex items-center justify-between">
                                    <div class="font-mono text-sm bg-gray-50 px-3 py-2 rounded w-full">
                                        {{ $site->database_username ?? $site->site_data['database_username'] ?? 'Not available' }}
                                    </div>
                                    <button onclick="copyToClipboard('{{ $site->database_username ?? $site->site_data['database_username'] ?? 'Not available' }}')" 
                                            class="ml-2 text-gray-400 hover:text-gray-600 focus:outline-none" title="Copy to clipboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div>
                                <div class="text-sm font-medium text-gray-400">Database Password</div>
                                <div class="mt-1 flex items-center justify-between">
                                    <div class="font-mono text-sm bg-gray-50 px-3 py-2 rounded w-full">
                                        {{ $site->database_password ?? $site->site_data['database_password'] ?? 'Not available' }}
                                    </div>
                                    <button onclick="copyToClipboard('{{ $site->database_password ?? $site->site_data['database_password'] ?? 'Not available' }}')" 
                                            class="ml-2 text-gray-400 hover:text-gray-600 focus:outline-none" title="Copy to clipboard">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            @if($site->server && $site->server->phpmyadmin_url)
                            <div class="mt-4 border-t border-gray-100 pt-4">
                                <div class="text-sm font-medium text-gray-400">phpMyAdmin</div>
                                <div class="mt-1 flex items-center">
                                    <a href="{{ $site->server->phpmyadmin_url }}" target="_blank" 
                                       class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center">
                                        Access phpMyAdmin
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            @endif
                            
                            <div class="mt-4 border-t border-gray-100 pt-4">
                                <div class="text-sm font-medium text-gray-400">Database ID</div>
                                <div class="mt-1 text-xs font-mono text-gray-500 break-all">
                                    {{ $site->database_id ?? $site->site_data['database_id'] ?? 'Not available' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white mt-12 py-6 border-t">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-500">
                    This page is publicly shared from the Sandbox admin panel.
                </p>
                <a href="https://serveravatar.com" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center">
                    Powered by ServerAvatar
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show a temporary notification
                const notification = document.createElement('div');
                notification.textContent = 'Copied to clipboard!';
                notification.style.position = 'fixed';
                notification.style.bottom = '20px';
                notification.style.right = '20px';
                notification.style.padding = '10px 15px';
                notification.style.backgroundColor = '#4F46E5';
                notification.style.color = 'white';
                notification.style.borderRadius = '5px';
                notification.style.fontSize = '14px';
                notification.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
                notification.style.zIndex = '1000';
                document.body.appendChild(notification);
                
                // Remove the notification after 2 seconds
                setTimeout(function() {
                    notification.style.opacity = '0';
                    notification.style.transition = 'opacity 0.5s ease';
                    setTimeout(function() {
                        document.body.removeChild(notification);
                    }, 500);
                }, 2000);
            }).catch(function(err) {
                console.error('Could not copy text: ', err);
            });
        }
    </script>
</body>
</html>
