<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Get the site we want to send a test email for
$site = \App\Models\Site::find(46);

if ($site) {
    // Create the email
    $email = new \App\Mail\SiteDeletionNotification($site);
    
    // Store the email preview in storage/logs/email_preview.html
    $html = $email->render();
    file_put_contents(__DIR__ . '/storage/logs/email_preview.html', $html);
    
    echo "Email preview generated at: /storage/logs/email_preview.html\n";
    
    // Send a test email if needed (uncomment below)
    // \Illuminate\Support\Facades\Mail::to('test@example.com')->send($email);
    // echo "Test email sent to test@example.com\n";
} else {
    echo "Site ID 46 not found.\n";
}