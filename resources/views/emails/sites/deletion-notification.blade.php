@component('mail::message')
# Site Deletion Notification

Dear User,

Your site **{{ $site->name }}** ({{ $site->domain }}) will be automatically deleted in about 30 minutes. 

If you want to continue using this site, please log in to your account and extend its expiration time.

@component('mail::button', ['url' => url('/login')])
Log in to your account
@endcomponent

Thank you for using our service.

Regards,<br>
Sandbox by ServerAvatar
@endcomponent