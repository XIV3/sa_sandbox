<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Check site 46 status
$site = \App\Models\Site::find(46);
if ($site) {
    echo "Site ID: {$site->id}\n";
    echo "Name: {$site->name}\n";
    echo "Expires at: {$site->expires_at}\n";
    echo "Email: {$site->email}\n";
    echo "Notification sent: " . ($site->deletion_notification_sent ? 'Yes' : 'No') . "\n";
} else {
    echo "Site ID 46 not found.\n";
}