<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Update site 46 to expire in 25 minutes
$site = \App\Models\Site::find(46);
if ($site) {
    $site->expires_at = now()->addMinutes(25);
    $site->save();
    echo "Updated site ID 46 to expire in 25 minutes.\n";
} else {
    echo "Site ID 46 not found.\n";
}