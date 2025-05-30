<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Sites Management') }}
                </h2>
                <p class="mt-1 text-gray-600 text-sm">
                    Manage your websites and applications
                </p>
            </div>
            <div>
                <button x-data @click="$dispatch('open-modal')" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Create New Site
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message (shown only if not from a form submission) -->
            @if(session('success') && !session('openCreateModal') && !$errors->any())
            <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                <p>{{ session('success') }}</p>
            </div>
            @endif
            
            <!-- Warning Message -->
            @if(session('warning'))
            <div class="mb-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p>{{ session('warning') }}</p>
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">All Sites</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Site Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Domain</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Server</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">PHP Version</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Expires In</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($sites as $site)
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm font-medium text-gray-900">{{ $site->name }}</td>
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
                                        @if($site->email)
                                        <span class="text-gray-600">{{ $site->email }}</span>
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
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <div x-data="{ deleting: false }" class="flex justify-end space-x-3">
                                            <a x-show="!deleting" href="{{ route('admin.sites.show', $site->uuid) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                            <form x-show="!deleting" action="{{ route('admin.sites.destroy', $site) }}" method="POST" class="inline" 
                                                  onsubmit="return confirm('Are you sure you want to delete this site?');"
                                                  @submit="deleting = true">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                            <span x-show="deleting" class="text-gray-500 italic">Deleting...</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-3 py-8 text-center text-sm text-gray-500">
                                        No sites found. <button x-data @click="$dispatch('open-modal')" class="text-indigo-600 hover:text-indigo-900 bg-transparent p-0 border-0 inline underline">Create your first site</button>.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                        
                        @if ($errors->any())
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
                                        <label for="reminder" class="font-medium text-gray-700">Send me site info and remind me before delete</label>
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
    
    <!-- Hidden test form for debug purposes -->
    @if(config('app.debug'))
    <div class="fixed bottom-4 right-4 z-50" x-data="{ testFormVisible: false }">
        <button type="button" @click="testFormVisible = !testFormVisible" class="px-4 py-2 bg-gray-800 text-white rounded-md shadow-md">
            Toggle Debug Form
        </button>
        
        <div x-show="testFormVisible" class="mt-2 p-4 bg-white border border-gray-300 rounded-md shadow-lg">
            <h4 class="font-bold text-sm mb-2">Debug Form</h4>
            <form action="{{ route('debug.form') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="test_field" class="block text-sm">Test Field</label>
                    <input type="text" name="test_field" id="test_field" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <button type="submit" class="px-3 py-1 bg-gray-200 text-gray-800 rounded">Submit Test</button>
            </form>
        </div>
    </div>
    @endif
</x-app-layout>
