<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
        <p class="mt-1 text-gray-600 text-sm">
            Overview of your server and application status
        </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Active Sites Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Active Sites</h3>
                                <div class="mt-2 flex items-baseline">
                                    <span class="text-3xl font-semibold text-indigo-600">24</span>
                                    <span class="ml-2 text-sm text-gray-600">websites</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.sites') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all sites &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Active Servers Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-emerald-100 text-emerald-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Active Servers</h3>
                                <div class="mt-2 flex items-baseline">
                                    <span class="text-3xl font-semibold text-emerald-600">12</span>
                                    <span class="ml-2 text-sm text-gray-600">servers</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.servers') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">Manage servers &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Sites To Be Deleted Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-red-100 text-red-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Sites to be Deleted</h3>
                                <div class="mt-2 flex items-baseline">
                                    <span class="text-3xl font-semibold text-red-600">3</span>
                                    <span class="ml-2 text-sm text-gray-600">within 1 hour</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="#" class="text-sm font-medium text-red-600 hover:text-red-500">View pending deletions &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Sites Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Recently Created Sites</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subdomain</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Server IP</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Password</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Row 1 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">blog.example.com</div>
                                                <div class="text-sm text-gray-500">WordPress Site</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">192.168.1.101</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ copied: false }">
                                            <span class="text-sm text-gray-900 mr-2">admin_user1</span>
                                            <button @click="navigator.clipboard.writeText('admin_user1'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ showPwd: false, copied: false }">
                                            <span x-show="showPwd" class="text-sm text-gray-900 mr-2">SecurePass123!</span>
                                            <span x-show="!showPwd" class="text-sm text-gray-900 mr-2">••••••••••••</span>
                                            <button @click="showPwd = !showPwd" class="text-gray-500 hover:text-gray-700 focus:outline-none mr-2">
                                                <svg x-show="!showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                            </button>
                                            <button @click="navigator.clipboard.writeText('SecurePass123!'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">March 25, 2025 (4 days ago)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-red-600 hover:text-red-900 focus:outline-none">Delete</button>
                                    </td>
                                </tr>
                                
                                <!-- Row 2 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">store.example.com</div>
                                                <div class="text-sm text-gray-500">E-commerce Site</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">192.168.1.102</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ copied: false }">
                                            <span class="text-sm text-gray-900 mr-2">store_admin</span>
                                            <button @click="navigator.clipboard.writeText('store_admin'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ showPwd: false, copied: false }">
                                            <span x-show="showPwd" class="text-sm text-gray-900 mr-2">StorePass456!</span>
                                            <span x-show="!showPwd" class="text-sm text-gray-900 mr-2">••••••••••••</span>
                                            <button @click="showPwd = !showPwd" class="text-gray-500 hover:text-gray-700 focus:outline-none mr-2">
                                                <svg x-show="!showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                            </button>
                                            <button @click="navigator.clipboard.writeText('StorePass456!'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">March 26, 2025 (3 days ago)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-red-600 hover:text-red-900 focus:outline-none">Delete</button>
                                    </td>
                                </tr>
                                
                                <!-- Row 3 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">api.example.com</div>
                                                <div class="text-sm text-gray-500">API Service</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">192.168.1.103</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ copied: false }">
                                            <span class="text-sm text-gray-900 mr-2">api_service</span>
                                            <button @click="navigator.clipboard.writeText('api_service'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ showPwd: false, copied: false }">
                                            <span x-show="showPwd" class="text-sm text-gray-900 mr-2">ApiKey789!</span>
                                            <span x-show="!showPwd" class="text-sm text-gray-900 mr-2">••••••••••</span>
                                            <button @click="showPwd = !showPwd" class="text-gray-500 hover:text-gray-700 focus:outline-none mr-2">
                                                <svg x-show="!showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                            </button>
                                            <button @click="navigator.clipboard.writeText('ApiKey789!'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">March 27, 2025 (2 days ago)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-red-600 hover:text-red-900 focus:outline-none">Delete</button>
                                    </td>
                                </tr>
                                
                                <!-- Row 4 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">docs.example.com</div>
                                                <div class="text-sm text-gray-500">Documentation Site</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">192.168.1.104</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ copied: false }">
                                            <span class="text-sm text-gray-900 mr-2">docs_admin</span>
                                            <button @click="navigator.clipboard.writeText('docs_admin'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ showPwd: false, copied: false }">
                                            <span x-show="showPwd" class="text-sm text-gray-900 mr-2">DocsPass321!</span>
                                            <span x-show="!showPwd" class="text-sm text-gray-900 mr-2">••••••••••••</span>
                                            <button @click="showPwd = !showPwd" class="text-gray-500 hover:text-gray-700 focus:outline-none mr-2">
                                                <svg x-show="!showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                            </button>
                                            <button @click="navigator.clipboard.writeText('DocsPass321!'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">March 28, 2025 (yesterday)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-red-600 hover:text-red-900 focus:outline-none">Delete</button>
                                    </td>
                                </tr>
                                
                                <!-- Row 5 -->
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center bg-indigo-100 text-indigo-600 rounded-full">
                                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                                </svg>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">app.example.com</div>
                                                <div class="text-sm text-gray-500">Web Application</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">192.168.1.105</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ copied: false }">
                                            <span class="text-sm text-gray-900 mr-2">app_manager</span>
                                            <button @click="navigator.clipboard.writeText('app_manager'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center" x-data="{ showPwd: false, copied: false }">
                                            <span x-show="showPwd" class="text-sm text-gray-900 mr-2">AppAdmin567!</span>
                                            <span x-show="!showPwd" class="text-sm text-gray-900 mr-2">••••••••••••</span>
                                            <button @click="showPwd = !showPwd" class="text-gray-500 hover:text-gray-700 focus:outline-none mr-2">
                                                <svg x-show="!showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                <svg x-show="showPwd" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                                </svg>
                                            </button>
                                            <button @click="navigator.clipboard.writeText('AppAdmin567!'); copied = true; setTimeout(() => copied = false, 2000)" class="text-indigo-600 hover:text-indigo-900 focus:outline-none">
                                                <svg x-show="!copied" class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                                                </svg>
                                                <svg x-show="copied" class="h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">March 29, 2025 (today)</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button class="text-red-600 hover:text-red-900 focus:outline-none">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.sites') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            View All Sites
                        </a>
                    </div>
                </div>
            </div>

            <!-- Welcome Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold mb-4">Welcome to Sandbox Admin</h1>
                    <p class="mb-4">This dashboard gives you an overview of your servers and applications. Use the navigation above to access different sections.</p>
                    
                    <!-- Steps to Get Started Section -->
                    <div class="mb-6">
                        <h3 class="font-medium text-gray-900 mb-3 text-lg">Steps to Get Started:</h3>
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <!-- Step 1 -->
                            <div class="flex items-start p-4 border-b border-gray-200">
                                <div class="flex-shrink-0 bg-indigo-100 rounded-full h-8 w-8 flex items-center justify-center mt-1">
                                    <span class="text-indigo-600 font-bold">1</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Configure Domain with Cloudflare</h4>
                                    <p class="text-gray-600 text-sm mt-1">Connect your domain with Cloudflare integration to enable automatic DNS management and advanced security features.</p>
                                    <a href="{{ route('admin.settings') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-500 mt-2 inline-block">Configure Cloudflare &rarr;</a>
                                </div>
                            </div>
                            
                            <!-- Step 2 -->
                            <div class="flex items-start p-4 border-b border-gray-200 bg-gray-50">
                                <div class="flex-shrink-0 bg-indigo-100 rounded-full h-8 w-8 flex items-center justify-center mt-1">
                                    <span class="text-indigo-600 font-bold">2</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Configure ServerAvatar API Information</h4>
                                    <p class="text-gray-600 text-sm mt-1">Connect to your ServerAvatar account by providing API keys and credentials to enable server management.</p>
                                    <a href="{{ route('admin.settings') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-500 mt-2 inline-block">Setup API Integration &rarr;</a>
                                </div>
                            </div>
                            
                            <!-- Step 3 -->
                            <div class="flex items-start p-4 border-b border-gray-200">
                                <div class="flex-shrink-0 bg-indigo-100 rounded-full h-8 w-8 flex items-center justify-center mt-1">
                                    <span class="text-indigo-600 font-bold">3</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Select Servers from ServerAvatar</h4>
                                    <p class="text-gray-600 text-sm mt-1">Choose which servers from your ServerAvatar account will be used to host temporary sites and applications.</p>
                                    <a href="{{ route('admin.servers') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-500 mt-2 inline-block">Select Servers &rarr;</a>
                                </div>
                            </div>
                            
                            <!-- Step 4 -->
                            <div class="flex items-start p-4 bg-gray-50">
                                <div class="flex-shrink-0 bg-indigo-100 rounded-full h-8 w-8 flex items-center justify-center mt-1">
                                    <span class="text-indigo-600 font-bold">4</span>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-900">Configure SMTP Settings</h4>
                                    <p class="text-gray-600 text-sm mt-1">Set up email delivery by configuring SMTP credentials to enable notifications and system alerts.</p>
                                    <a href="{{ route('admin.settings') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-500 mt-2 inline-block">Configure Email &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quick Tips Section -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <h3 class="font-medium text-gray-900 mb-2">Quick Tips:</h3>
                        <ul class="list-disc list-inside space-y-1 text-gray-600">
                            <li>Use the <strong>Sites</strong> section to manage your websites and applications</li>
                            <li>Configure your servers in the <strong>Select Servers</strong> section</li>
                            <li>Adjust global preferences in <strong>System Settings</strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>