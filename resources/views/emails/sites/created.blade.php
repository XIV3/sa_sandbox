@component('mail::message')
# Your WordPress Site Has Been Created

Your WordPress site **{{ $site->domain }}** has been successfully deployed and is ready to use!

## Site Information
- **Site URL:** [{{ 'https://' . $site->domain }}]({{ 'https://' . $site->domain }})
- **WordPress Admin:** [{{ 'https://' . $site->domain }}/wp-admin]({{ 'https://' . $site->domain }}/wp-admin)
- **Username:** {{ $site->wp_username ?? $site->site_data['wp_username'] ?? 'admin' }}
- **Password:** {{ $site->site_data['wp_password'] ?? '*****' }}

## Database Information
- **Database Name:** {{ $site->database_name ?? $site->site_data['database_name'] ?? 'N/A' }}
- **Database Username:** {{ $site->database_username ?? $site->site_data['database_username'] ?? 'N/A' }}
- **Database Password:** {{ $site->database_password ?? $site->site_data['database_password'] ?? '*****' }}
- **Database Host:** {{ $site->database_host ?? $site->site_data['database_host'] ?? 'localhost' }}

@if($site->is_public)
## Public Information Page
A public information page for your site is available at:
[{{ route('sites.public.show', $site->uuid) }}]({{ route('sites.public.show', $site->uuid) }})
@endif

## Site Expiration
@if($site->expires_at)
This site will expire and be automatically deleted on **{{ $site->expires_at->format('F j, Y, g:i a e') }}**.
@else
This site does not expire and will need be to deleted manually, when needed.
@endif

@component('mail::button', ['url' => 'https://' . $site->domain . '/wp-admin'])
Visit WordPress Admin
@endcomponent

Thank you for using our service!

Regards,
{{ config('app.name') }}
@endcomponent
