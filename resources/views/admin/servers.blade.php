<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Select Servers') }}
        </h2>
        <p class="mt-1 text-gray-600 text-sm">
            Choose and configure servers for your applications
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Selected Servers Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Selected Servers</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="relative py-3.5 pl-4 pr-3 sm:pl-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">IP Address</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Connection Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Hosted Sites</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">CPU Usage</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">RAM Usage</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Disk Usage</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <!-- Example selected server 1 -->
                                <tr>
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-red-600 hover:text-red-900">Remove</button>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">Web Server 1</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">192.168.1.101</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Connected
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-900">12</span>
                                            <span class="ml-1 text-sm text-gray-500">sites</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                                            </div>
                                            <span class="ml-2">45%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 62%"></div>
                                            </div>
                                            <span class="ml-2">62%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 28%"></div>
                                            </div>
                                            <span class="ml-2">28%</span>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Example selected server 2 -->
                                <tr>
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-red-600 hover:text-red-900">Remove</button>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">Database Server</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">192.168.1.102</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <span class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Connected
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-900">8</span>
                                            <span class="ml-1 text-sm text-gray-500">sites</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 32%"></div>
                                            </div>
                                            <span class="ml-2">32%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 78%"></div>
                                            </div>
                                            <span class="ml-2">78%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 56%"></div>
                                            </div>
                                            <span class="ml-2">56%</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- All Available Servers Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">All Available Servers</h3>
                    
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
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">IP Address</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Connection Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Cores</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">CPU Usage</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">RAM Usage</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Disk Usage</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($servers as $server)
                                <tr>
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-indigo-600 hover:text-indigo-900">Add</button>
                                    </td>
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
                                        {{ isset($server['cores']) && is_numeric($server['cores']) ? $server['cores'] : 'N/A' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if(isset($server['latest_monitor_log']) && isset($server['latest_monitor_log']['load_average']))
                                        <div class="flex items-center">
                                            @php
                                                // The API already returns load average as a percentage
                                                $loadPercentage = is_numeric($server['latest_monitor_log']['load_average']) ? 
                                                    min(100, max(0, floatval($server['latest_monitor_log']['load_average']))) : 0;
                                                $loadColor = $loadPercentage > 80 ? 'bg-red-600' : ($loadPercentage > 60 ? 'bg-yellow-600' : 'bg-blue-600');
                                            @endphp
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="{{ $loadColor }} h-2.5 rounded-full" style="width: {{ $loadPercentage }}%"></div>
                                            </div>
                                            <span class="ml-2">{{ $loadPercentage }}%</span>
                                        </div>
                                        @else
                                        <div class="flex items-center">
                                            <span class="text-gray-400">N/A</span>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if(isset($server['latest_monitor_log']) && isset($server['latest_monitor_log']['memory_usage']))
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                @php
                                                    $memoryPercentage = is_numeric($server['latest_monitor_log']['memory_usage']) ? floatval($server['latest_monitor_log']['memory_usage']) : 0;
                                                    $memoryPercentage = min(100, max(0, round($memoryPercentage)));
                                                    $memoryColor = $memoryPercentage > 80 ? 'bg-red-600' : ($memoryPercentage > 60 ? 'bg-yellow-600' : 'bg-blue-600');
                                                @endphp
                                                <div class="{{ $memoryColor }} h-2.5 rounded-full" style="width: {{ $memoryPercentage }}%"></div>
                                            </div>
                                            <span class="ml-2">{{ $memoryPercentage }}%</span>
                                        </div>
                                        @else
                                        <div class="flex items-center">
                                            <span class="text-gray-400">N/A</span>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if(isset($server['latest_monitor_log']) && isset($server['latest_monitor_log']['disk_usage']))
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                @php
                                                    $diskPercentage = is_numeric($server['latest_monitor_log']['disk_usage']) ? floatval($server['latest_monitor_log']['disk_usage']) : 0;
                                                    $diskPercentage = min(100, max(0, round($diskPercentage)));
                                                    $diskColor = $diskPercentage > 80 ? 'bg-red-600' : ($diskPercentage > 60 ? 'bg-yellow-600' : 'bg-blue-600');
                                                @endphp
                                                <div class="{{ $diskColor }} h-2.5 rounded-full" style="width: {{ $diskPercentage }}%"></div>
                                            </div>
                                            <span class="ml-2">{{ $diskPercentage }}%</span>
                                        </div>
                                        @else
                                        <div class="flex items-center">
                                            <span class="text-gray-400">N/A</span>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr class="empty-row">
                                    <td colspan="7" class="px-3 py-8 text-center text-sm text-gray-500">
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

</x-app-layout>