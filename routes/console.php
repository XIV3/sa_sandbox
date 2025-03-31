<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule the delete expired sites command to run every hour
Schedule::command('sites:delete-expired')->everyMinute();

// Schedule the refresh server status command to run every 5 minutes
Schedule::command('servers:refresh-status')->everyFiveMinutes();

// Schedule the send deletion notifications command to run every 5 minutes
Schedule::command('app:send-deletion-notifications')->everyFiveMinutes();