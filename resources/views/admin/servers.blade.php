<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Servers') }}
        </h2>
        <p class="mt-1 text-gray-600 text-sm">
            Choose and configure servers for your applications
        </p>
    </x-slot>
    
    <style>
        /* Styles for server sites feature */
        .sites-row {
            transition: all 0.3s ease;
        }
        .sites-row.hidden {
            display: none;
        }
        .chevron-icon {
            transition: transform 0.3s ease;
        }
        .toggle-sites-btn:hover .chevron-icon {
            color: rgb(79, 70, 229);
        }
        .server-row:hover {
            background-color: rgb(249, 250, 251);
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Selected Servers Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-1">Selected Servers</h3>
                    <p class="mb-4 text-sm text-gray-600">Servers that you have chosen to manage applications on. These servers will be available when creating new sites.</p>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="relative py-3.5 pl-4 pr-3 sm:pl-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server ID</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">IP Address</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Connection Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Web Server</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Database Server</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cores</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Sites</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($selectedServers as $server)
                                <tr class="server-row" data-server-id="{{ $server->server_id }}">
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-red-600 hover:text-red-900 remove-server-btn" data-server-id="{{ $server->server_id }}">Remove</button>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $server->server_id }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">{{ $server->name }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $server->ip_address }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if($server->connection_status == 'connected')
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Connected
                                        </span>
                                        @elseif($server->connection_status == 'disconnected')
                                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Disconnected
                                        </span>
                                        @else
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Unknown
                                        </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ ucfirst($server->web_server) ?? 'N/A' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ ucfirst($server->database_type) ?? 'N/A' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $server->cores ?? 'N/A' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <button type="button" class="inline-flex items-center text-indigo-600 hover:text-indigo-900 toggle-sites-btn" data-server-id="{{ $server->server_id }}">
                                            <span class="site-count">{{ $server->sites->count() }}</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 chevron-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="sites-row hidden" data-server-id="{{ $server->server_id }}">
                                    <td colspan="9" class="px-3 py-4">
                                        <div class="border rounded-md bg-gray-50 p-4">
                                            <h4 class="text-sm font-medium text-gray-900 mb-2">Sites on {{ $server->name }}</h4>
                                            @if($server->sites->count() > 0)
                                                <div class="overflow-x-auto">
                                                    <table class="min-w-full divide-y divide-gray-200">
                                                        <thead class="bg-gray-100">
                                                            <tr>
                                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-700">Name</th>
                                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-700">Domain</th>
                                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-700">Status</th>
                                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-700">Expires at</th>
                                                                <th scope="col" class="px-3 py-2 text-left text-xs font-medium text-gray-700">Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-gray-200 bg-white">
                                                            @foreach($server->sites as $site)
                                                                <tr>
                                                                    <td class="whitespace-nowrap px-3 py-2 text-xs text-gray-900">{{ $site->name }}</td>
                                                                    <td class="whitespace-nowrap px-3 py-2 text-xs text-gray-900">{{ $site->domain }}</td>
                                                                    <td class="whitespace-nowrap px-3 py-2 text-xs">
                                                                        @if($site->status == 'active')
                                                                            <span class="inline-flex items-center rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">Active</span>
                                                                        @elseif($site->status == 'pending')
                                                                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-2 py-0.5 text-xs font-medium text-yellow-800">Pending</span>
                                                                        @else
                                                                            <span class="inline-flex items-center rounded-full bg-gray-100 px-2 py-0.5 text-xs font-medium text-gray-800">{{ ucfirst($site->status) }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td class="whitespace-nowrap px-3 py-2 text-xs text-gray-900">
                                                                        {{ $site->expires_at ? $site->expires_at->format('Y-m-d H:i') : 'N/A' }}
                                                                    </td>
                                                                    <td class="whitespace-nowrap px-3 py-2 text-xs text-gray-900">
                                                                        <a href="{{ route('admin.sites.show', $site->id) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            @else
                                                <p class="text-sm text-gray-500">No sites on this server.</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="9" class="px-3 py-8 text-center text-sm text-gray-500">
                                        No servers selected. Add servers from the list below.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- All Available Servers Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">All Available Servers</h3>
                            <p class="text-sm text-gray-600 mt-1">Servers from your ServerAvatar account that can be added to your selected servers list.</p>
                        </div>
                        <a href="{{ route('admin.servers') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Refresh
                        </a>
                    </div>
                    
                    @if(!$apiConfigured)
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        ServerAvatar API is not configured. Please <a href="{{ route('admin.settings.index') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">visit settings</a> to configure the API.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @elseif($errorMessage)
                        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700">
                                        {{ $errorMessage }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="relative py-3.5 pl-4 pr-3 sm:pl-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server ID</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">IP Address</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Connection Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Web Server</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Database Server</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cores</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($servers as $server)
                                <tr>
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-indigo-600 hover:text-indigo-900 add-server-btn" data-server-id="{{ $server['id'] }}">Add</button>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $server['id'] ?? 'N/A' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">{{ $server['name'] }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $server['ip'] }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if($server['agent_status'] == '1')
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Connected
                                        </span>
                                        @else
                                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Disconnected
                                        </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ isset($server['web_server']) ? ucfirst($server['web_server']) : 'N/A' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ isset($server['database_type']) ? ucfirst($server['database_type']) : 'N/A' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ isset($server['cores']) && is_numeric($server['cores']) ? $server['cores'] : 'N/A' }}
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="8" class="px-3 py-8 text-center text-sm text-gray-500">
                                        @if($apiConfigured && !$errorMessage)
                                            No servers available.
                                        @else
                                            No data available. Please check API configuration.
                                        @endif
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination -->
                    @if(isset($pagination) && !empty($pagination))
                    <div class="py-3 border-t border-gray-200 mt-4">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Showing {{ $pagination['from'] ?? 1 }} to {{ $pagination['to'] ?? count($servers) }} of {{ $pagination['total'] ?? count($servers) }} servers
                            </div>
                            <div class="flex-1 flex justify-between sm:justify-end">
                                @if(isset($pagination['prev_page_url']) && $pagination['prev_page_url'])
                                    <a href="{{ $pagination['prev_page_url'] }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Previous
                                    </a>
                                @else
                                    <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-gray-50 cursor-not-allowed">
                                        Previous
                                    </span>
                                @endif

                                @if(isset($pagination['next_page_url']) && $pagination['next_page_url'])
                                    <a href="{{ $pagination['next_page_url'] }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Next
                                    </a>
                                @else
                                    <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-300 bg-gray-50 cursor-not-allowed">
                                        Next
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="py-3 border-t border-gray-200 mt-4">
                        <p class="text-sm text-gray-700">
                            Showing {{ count($servers) }} server(s)
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages Modal -->
    <div id="notification-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div id="notification-icon-success" class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10 hidden">
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div id="notification-icon-error" class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10 hidden">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="notification-title"></h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500" id="notification-message"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm" id="notification-close-btn">
                    Close
                </button>
            </div>
        </div>
    </div>

    <!-- Server Management JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const notificationModal = document.getElementById('notification-modal');
            const notificationTitle = document.getElementById('notification-title');
            const notificationMessage = document.getElementById('notification-message');
            const notificationCloseBtn = document.getElementById('notification-close-btn');
            const notificationIconSuccess = document.getElementById('notification-icon-success');
            const notificationIconError = document.getElementById('notification-icon-error');
            
            // Add event listeners for add server buttons
            document.querySelectorAll('.add-server-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const serverId = this.getAttribute('data-server-id');
                    addServer(serverId);
                });
            });
            
            // Add event listeners for remove server buttons
            document.querySelectorAll('.remove-server-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const serverId = this.getAttribute('data-server-id');
                    removeServer(serverId);
                });
            });
            
            // Add event listeners for toggle sites buttons
            document.querySelectorAll('.toggle-sites-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const serverId = this.getAttribute('data-server-id');
                    toggleSites(serverId);
                });
            });
            
            // Close notification modal
            notificationCloseBtn.addEventListener('click', function() {
                notificationModal.classList.add('hidden');
            });
            
            // Toggle sites for a server
            function toggleSites(serverId) {
                const sitesRow = document.querySelector(`.sites-row[data-server-id="${serverId}"]`);
                const button = document.querySelector(`.toggle-sites-btn[data-server-id="${serverId}"]`);
                const chevronIcon = button.querySelector('.chevron-icon');
                
                if (sitesRow.classList.contains('hidden')) {
                    // Show sites
                    sitesRow.classList.remove('hidden');
                    // Rotate the chevron icon
                    chevronIcon.style.transform = 'rotate(180deg)';
                } else {
                    // Hide sites
                    sitesRow.classList.add('hidden');
                    // Reset the chevron icon
                    chevronIcon.style.transform = 'rotate(0)';
                }
            }
            
            // Add server function
            function addServer(serverId) {
                fetch('{{ route("admin.server-management.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ server_id: serverId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Success', data.message, 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    showNotification('Error', 'An unexpected error occurred. Please try again.', 'error');
                    console.error('Error:', error);
                });
            }
            
            // Remove server function
            function removeServer(serverId) {
                fetch('{{ route("admin.server-management.remove") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ server_id: serverId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('Success', data.message, 'success');
                        setTimeout(() => {
                            window.location.reload();
                        }, 1500);
                    } else {
                        showNotification('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    showNotification('Error', 'An unexpected error occurred. Please try again.', 'error');
                    console.error('Error:', error);
                });
            }
            
            // Show notification modal
            function showNotification(title, message, type) {
                notificationTitle.textContent = title;
                notificationMessage.textContent = message;
                
                if (type === 'success') {
                    notificationIconSuccess.classList.remove('hidden');
                    notificationIconError.classList.add('hidden');
                } else {
                    notificationIconSuccess.classList.add('hidden');
                    notificationIconError.classList.remove('hidden');
                }
                
                notificationModal.classList.remove('hidden');
            }
        });
    </script>
</x-app-layout>