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
                    
                    <div class="mb-4">
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="search" id="search" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" placeholder="Search servers...">
                        </div>
                    </div>
                    
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
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">CPU Usage</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">RAM Usage</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Disk Usage</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <!-- Example server 1 -->
                                <tr>
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-indigo-600 hover:text-indigo-900">Add</button>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">Web Server 3</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">192.168.1.103</td>
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
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 15%"></div>
                                            </div>
                                            <span class="ml-2">15%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 22%"></div>
                                            </div>
                                            <span class="ml-2">22%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 18%"></div>
                                            </div>
                                            <span class="ml-2">18%</span>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Example server 2 -->
                                <tr>
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-indigo-600 hover:text-indigo-900">Add</button>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">Cache Server</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">192.168.1.104</td>
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
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 35%"></div>
                                            </div>
                                            <span class="ml-2">35%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 48%"></div>
                                            </div>
                                            <span class="ml-2">48%</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                                <div class="bg-blue-600 h-2.5 rounded-full" style="width: 26%"></div>
                                            </div>
                                            <span class="ml-2">26%</span>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Example server 3 -->
                                <tr>
                                    <td class="relative whitespace-nowrap py-4 pl-4 pr-3 text-left text-sm font-medium sm:pl-6">
                                        <button type="button" class="text-indigo-600 hover:text-indigo-900">Add</button>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">Load Balancer</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">192.168.1.105</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        <span class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800">
                                            <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                <circle cx="4" cy="4" r="3" />
                                            </svg>
                                            Disconnected
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <span class="text-gray-400">N/A</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <span class="text-gray-400">N/A</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <span class="text-gray-400">N/A</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Server Count Summary -->
                    <div class="py-3 border-t border-gray-200 mt-4">
                        <p class="text-sm text-gray-700">
                            Showing all <span class="font-medium">3</span> available servers
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>