<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\SelectedServer;
use App\Services\SystemSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SiteController extends Controller
{
    /**
     * The SystemSettingsService instance.
     *
     * @var \App\Services\SystemSettingsService
     */
    protected $systemSettings;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\SystemSettingsService $systemSettings
     * @return void
     */
    public function __construct(SystemSettingsService $systemSettings)
    {
        $this->systemSettings = $systemSettings;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = Site::with('server')->latest()->get();
        $servers = SelectedServer::all();
        $domain = $this->systemSettings->getDomain();
        
        return view('admin.sites', compact('sites', 'servers', 'domain'));
    }

    /**
     * Show the form for creating a new resource (redirects to index with modal).
     */
    public function create()
    {
        return redirect()->route('admin.sites.index')
            ->with('openCreateModal', true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = validator($request->all(), [
            'subdomain' => 'required|string|max:255|regex:/^[a-z0-9-]+$/|unique:sites,domain',
            'email' => 'nullable|email|required_if:send_email,on',
            'send_email' => 'nullable|string',
        ], [
            'subdomain.regex' => 'The subdomain may only contain lowercase letters, numbers, and hyphens.',
            'subdomain.unique' => 'This subdomain is already taken. Please choose another one.',
            'email.required_if' => 'The email field is required when notification is enabled.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('admin.sites.index')
                ->withErrors($validator)
                ->withInput()
                ->with('openCreateModal', true);
        }
        
        $validated = $validator->validated();

        // Construct full domain
        $domain = $validated['subdomain'] . '.' . $this->systemSettings->getDomain();
        
        // Get a random server for the throwaway site
        $server = SelectedServer::inRandomOrder()->first();
        
        if (!$server) {
            return redirect()->route('admin.sites.index')
                ->with('error', 'No server available to create site. Please add a server first.')
                ->withInput()
                ->with('openCreateModal', true);
        }
        
        // Prepare site data
        $siteData = [
            'name' => $validated['subdomain'],
            'domain' => $domain,
            'selected_server_id' => $server->id,
            'server_id' => $server->server_id,
            'status' => 'active',
            'uuid' => Str::random(32),
        ];
        
        // Add email to site_data if provided
        if (isset($validated['send_email']) && $validated['send_email'] === 'on') {
            $siteData['site_data'] = ['notification_email' => $validated['email']];
        }
        
        // Create the site
        $site = Site::create($siteData);

        return redirect()->route('admin.sites.index')
            ->with('success', 'Throwaway site created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        $site->load('server');
        return view('admin.sites.show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        // Get domain from settings
        $domainSetting = $this->systemSettings->getDomain();
        
        // Extract the subdomain from the full domain
        $subdomain = str_replace('.' . $domainSetting, '', $site->domain);
        
        // Get notification email if exists
        $notificationEmail = $site->site_data['notification_email'] ?? null;
        
        return view('admin.sites.edit', compact('site', 'subdomain', 'notificationEmail', 'domainSetting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $validator = validator($request->all(), [
            'subdomain' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', Rule::unique('sites', 'domain')->ignore($site->id)],
            'email' => 'nullable|email|required_if:send_email,on',
            'send_email' => 'nullable|string',
            'status' => 'required|string|in:active,inactive,maintenance',
        ], [
            'subdomain.regex' => 'The subdomain may only contain lowercase letters, numbers, and hyphens.',
            'subdomain.unique' => 'This subdomain is already taken. Please choose another one.',
            'email.required_if' => 'The email field is required when notification is enabled.',
        ]);
        
        if ($validator->fails()) {
            return redirect()->route('admin.sites.edit', $site)
                ->withErrors($validator)
                ->withInput();
        }
        
        $validated = $validator->validated();

        // Construct full domain
        $domain = $validated['subdomain'] . '.' . $this->systemSettings->getDomain();
        
        // Prepare site data for update
        $siteData = [
            'name' => $validated['subdomain'],
            'domain' => $domain,
            'status' => $validated['status'],
        ];
        
        // Update site_data if email notification is enabled/disabled
        if (isset($validated['send_email']) && $validated['send_email'] === 'on') {
            $siteData['site_data'] = array_merge($site->site_data ?? [], ['notification_email' => $validated['email']]);
        } else {
            // Remove notification email if it exists
            $siteData['site_data'] = $site->site_data ?? [];
            if (isset($siteData['site_data']['notification_email'])) {
                unset($siteData['site_data']['notification_email']);
            }
        }

        // Update the site
        $site->update($siteData);

        return redirect()->route('admin.sites.index')
            ->with('success', 'Site updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        $site->delete();
        return redirect()->route('admin.sites.index')
            ->with('success', 'Site deleted successfully.');
    }
}
