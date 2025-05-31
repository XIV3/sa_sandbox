<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="mt-1 text-gray-600 text-sm">
                    Overview of your server and application status
                </p>
            </div>
            <div>
                <button x-data @click="$dispatch('open-modal')" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="h-4 w-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create New Site
                </button>
            </div>
        </div>
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
                                    <span class="text-3xl font-semibold text-indigo-600">{{ \App\Models\Site::count() }}</span>
                                    <span class="ml-2 text-sm text-gray-600">website{{ \App\Models\Site::count() == 1 ? '' : 's' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.sites.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all sites &rarr;</a>
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
                                    <span class="text-3xl font-semibold text-emerald-600">{{ \App\Models\SelectedServer::count() }}</span>
                                    <span class="ml-2 text-sm text-gray-600">server{{ \App\Models\SelectedServer::count() == 1 ? '' : 's' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.servers') }}" class="text-sm font-medium text-emerald-600 hover:text-emerald-500">Manage servers &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- Current Timeout Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-orange-100 text-orange-600">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">Current Timeout</h3>
                                <div class="mt-2 flex items-baseline">
                                    <span class="text-3xl font-semibold text-orange-600">{{ \App\Models\SystemSetting::where('meta_key', 'default_deletion_time')->value('meta_value') ?? 24 }}</span>
                                    <span class="ml-2 text-sm text-gray-600">hour{{ \App\Models\SystemSetting::where('meta_key', 'default_deletion_time')->value('meta_value') == '1' ? '' : 's' }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.settings.index') }}" class="text-sm font-medium text-orange-600 hover:text-orange-500">Change timeout setting &rarr;</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Sites Table -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Recently Created Sites</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Site Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Domain</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">PHP Version</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Expires In</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created At</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse (\App\Models\Site::with('server')->latest()->take(5)->get() as $site)
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                                        @if($site->status == 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-green-600 mr-1.5"></span>
                                            Active
                                        </span>
                                        @elseif($site->status == 'maintenance')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-yellow-600 mr-1.5"></span>
                                            Maintenance
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <span class="h-1.5 w-1.5 rounded-full bg-red-600 mr-1.5"></span>
                                            Inactive
                                        </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">
                                        <a href="{{ route('admin.sites.show', $site->uuid) }}" class="text-blue-600 hover:text-blue-900">{{ $site->name }}</a>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        <a href="https://{{ $site->domain }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 hover:underline flex items-center">
                                            {{ $site->domain }}
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $site->server->name ?? 'N/A' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if($site->php_version)
                                        <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-xs font-medium">
                                            PHP {{ $site->php_version }}
                                        </span>
                                        @else
                                        <span class="text-gray-400">N/A</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if($site->expires_at)
                                            @if($site->expires_at->isPast())
                                                <span class="px-2 py-1 bg-red-50 text-red-700 rounded text-xs font-medium">
                                                    Expired
                                                </span>
                                            @else
                                                <span class="px-2 py-1 bg-yellow-50 text-yellow-700 rounded text-xs font-medium">
                                                    {{ $site->expires_at->diffForHumans(['parts' => 2]) }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="text-gray-400">NEVER</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $site->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div class="flex justify-end space-x-3">
                                            <form action="{{ route('admin.sites.destroy', $site) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this site?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-3 py-8 text-center text-sm text-gray-500">
                                        No sites found. <button x-data @click="$dispatch('open-modal')" class="text-indigo-600 hover:text-indigo-900 bg-transparent p-0 border-0 inline underline">Create your first site</button>.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.sites.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
                                    <a href="{{ route('admin.settings.index') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-500 mt-2 inline-block">Configure Cloudflare &rarr;</a>
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
                                    <a href="{{ route('admin.settings.index') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-500 mt-2 inline-block">Setup API Integration &rarr;</a>
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
                                    <a href="{{ route('admin.settings.index') }}" class="text-indigo-600 text-sm font-medium hover:text-indigo-500 mt-2 inline-block">Configure Email &rarr;</a>
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
    
    <!-- Create Site Modal -->
    <div 
        x-data="{ 
            open: {{ session('openCreateModal') || $errors->any() ? 'true' : 'false' }},
            loading: false,
            sendEmail: {{ old('reminder') ? 'true' : 'false' }},
            setUserEmail() {
                if (this.sendEmail && this.$refs.emailInput && !this.$refs.emailInput.value) {
                    this.$refs.emailInput.value = '{{ auth()->user()->email ?? '' }}';
                }
            }
        }" 
        x-show="open" 
        @open-modal.window="open = true" 
        @keydown.escape.window="open = false" 
        class="fixed inset-0 z-50 overflow-y-auto" 
        x-cloak
    >
        <!-- Background overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" x-show="open"></div>
        
        <!-- Modal panel -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-xl w-full max-h-full overflow-hidden" x-show="open">
                
                <!-- Modal header -->
                <div class="px-6 py-4 border-b bg-gray-50">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Create New Site</h3>
                        <button @click="open = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Modal content with form -->
                <form 
                    x-data="{ 
                        submitForm(event) {
                            event.preventDefault();
                            loading = true;
                            
                            // Reset error messages
                            this.errors = {};
                            this.errorMessage = '';
                            
                            const form = event.target;
                            const formData = new FormData(form);
                            
                            fetch('{{ route('admin.sites.store') }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                loading = false;
                                
                                if (data.success) {
                                    // Success! Redirect to the site details page
                                    window.location.href = data.redirect;
                                } else {
                                    // Handle validation errors or other issues
                                    if (data.errors) {
                                        this.errors = data.errors;
                                    }
                                    
                                    if (data.message) {
                                        this.errorMessage = data.message;
                                    }
                                }
                            })
                            .catch(error => {
                                loading = false;
                                this.errorMessage = 'An unexpected error occurred. Please try again.';
                                console.error('Error:', error);
                            });
                        },
                        errors: {},
                        errorMessage: ''
                    }"
                    @submit="submitForm"
                    method="POST">
                    @csrf
                    
                    <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                        <!-- AJAX Error Message -->
                        <div 
                            x-show="errorMessage" 
                            x-cloak
                            class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" 
                            role="alert"
                        >
                            <p x-text="errorMessage"></p>
                        </div>
                        
                        <!-- AJAX Validation Errors -->
                        <div 
                            x-show="Object.keys(errors).length > 0" 
                            x-cloak
                            class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" 
                            role="alert"
                        >
                            <p class="font-bold">Please fix the following errors:</p>
                            <ul class="list-disc list-inside">
                                <template x-for="(fieldErrors, field) in errors" :key="field">
                                    <template x-for="error in fieldErrors" :key="error">
                                        <li x-text="error"></li>
                                    </template>
                                </template>
                            </ul>
                        </div>
                        
                        <!-- Legacy server-side messages (for non-JS fallback) -->
                        @if(session('success') && session('openCreateModal'))
                        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                        @endif
                        
                        @if(session('error'))
                        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                        @endif
                        
                        @if($errors->any())
                        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Please fix the following errors:</p>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        
                        <div class="space-y-6">
                            <div>
                                <label for="subdomain" class="block text-sm font-medium text-gray-700 mb-2">Choose Your Subdomain</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 pl-3 pr-1 text-gray-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                        </svg>
                                    </span>
                                    <input type="text" name="subdomain" id="subdomain" value="{{ old('subdomain') }}" required class="block w-full min-w-0 flex-1 rounded-none border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ $errors->has('subdomain') ? 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500' : '' }}" placeholder="yoursite">
                                    <span class="inline-flex items-center rounded-r-md border border-l-0 border-gray-300 bg-gray-50 px-3 text-gray-500 sm:text-sm">{{ App\Models\SystemSetting::where('meta_key', 'subdomain_postfix')->first()->meta_value }}.{{ App\Models\SystemSetting::where('meta_key', 'domain')->first()->meta_value ?? 'example.com' }}</span>
                                </div>
                                <p class="mt-2 text-xs text-gray-500">Only lowercase letters, numbers and hyphens allowed.</p>
                                <p 
                                    x-show="errors.subdomain && errors.subdomain.length > 0" 
                                    x-text="errors.subdomain && errors.subdomain[0]" 
                                    class="mt-1 text-xs text-red-600"
                                ></p>
                                @error('subdomain')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                @if( \App\Models\SystemSetting::where('meta_key', 'allow_permanent_sites')->value('meta_value') == '1' )
                                <div class="flex items-start mb-3">
                                    <div class="flex h-5 items-center">
                                        <input id="permanent" name="permanent" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"> 
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="permanent" class="font-medium text-gray-700">Create a permanent site that does not expire</label>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="flex items-start mb-3">
                                    <div class="flex h-5 items-center">
                                        <input id="reminder" name="reminder" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" 
                                              x-model="sendEmail"
                                              @change="setUserEmail()">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="reminder" class="font-medium text-gray-700">Send me site info upon creation and remind me before deletion</label>
                                    </div>
                                </div>
                                
                                <div x-show="sendEmail">
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                    <div class="mt-1 flex rounded-md shadow-sm">
                                        <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 pl-3 pr-1 text-gray-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </span>
                                        <input type="email" name="email" id="email" x-ref="emailInput" value="{{ old('email') }}" class="block w-full min-w-0 flex-1 rounded-none rounded-r-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm {{ $errors->has('email') ? 'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500' : '' }}" placeholder="your@email.com">
                                    </div>
                                    <p class="mt-2 text-xs text-gray-500">We'll send login details and a reminder before your site is deleted.</p>
                                    <p 
                                        x-show="errors.email && errors.email.length > 0" 
                                        x-text="errors.email && errors.email[0]" 
                                        class="mt-1 text-xs text-red-600"
                                    ></p>
                                    @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="mt-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                                    <p class="text-sm">Creating a WordPress site may take 1-2 minutes. Please wait while we set up your site.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit button in form footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t">
                        <button type="submit"
                            :disabled="loading"
                            class="inline-flex w-full items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50">
                            <span x-show="!loading">Create WordPress Site</span>
                            <span x-show="loading">Creating site...</span>
                            <svg x-show="!loading" xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            <svg x-show="loading" class="animate-spin ml-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
