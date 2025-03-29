<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full {{ $site->status == 'active' ? 'bg-green-500' : ($site->status == 'maintenance' ? 'bg-yellow-500' : 'bg-red-500') }} animate-pulse"></span>
                    {{ $site->name }}
                </h2>
                <div class="mt-1 text-gray-600 text-sm flex items-center gap-2">
                    <span>{{ $site->domain }}</span>
                    <a href="https://{{ $site->domain }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.sites.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Sites
                </a>
                <form action="{{ route('admin.sites.destroy', $site) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this site?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete Site
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

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
                                    <div class="mt-1 text-base text-gray-900">{{ $site->created_at->format('F j, Y g:i A') }}</div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">Notification Email</div>
                                    <div class="mt-1 text-base text-gray-900">
                                        {{ $site->email ?? ($site->site_data['notification_email'] ?? 'None') }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-400">PHP Version</div>
                                    <div class="mt-1 text-base text-gray-900">
                                        <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-medium">
                                            PHP {{ $site->php_version ?? 'Not specified' }}
                                        </span>
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
                                        {{ !empty($site->site_data['dns_record']['created_at']) ? \Carbon\Carbon::parse($site->site_data['dns_record']['created_at'])->format('F j, Y g:i A') : 'Not available' }}
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
                </div>

                <!-- Credentials Sidebar -->
                <div class="col-span-1">
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 012 2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 012 2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 012 2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 012 2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
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
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002-2h2a2 2 0 012 2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

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
</x-app-layout>