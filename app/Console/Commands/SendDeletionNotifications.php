<?php

namespace App\Console\Commands;

use App\Mail\SiteDeletionNotification;
use App\Models\Site;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendDeletionNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-deletion-notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to users about site deletions 30 minutes before deletion';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Started checking for sites to notify...');
        
        // Log the current time
        $now = Carbon::now();
        $threshold = $now->copy()->addMinutes(35);
        $this->info("Current time: {$now}, Threshold: {$threshold}");
        
        // Get all sites first to see what we have
        $allSites = Site::all();
        $this->info("Total sites in database: " . $allSites->count());
        
        foreach ($allSites as $site) {
            $this->info("Site ID: {$site->id}, Name: {$site->name}, Expires: {$site->expires_at}, Email: " . 
                ($site->email ?? 'none') . ", Notified: " . ($site->deletion_notification_sent ? 'yes' : 'no'));
        }
        
        // Find sites expiring in less than 35 minutes but haven't been notified yet
        $query = Site::query()
            ->where('expires_at', '<=', $threshold)
            ->where('deletion_notification_sent', false)
            ->whereNotNull('email');
            
        // Log the query being executed
        $this->info("Executing query: " . $query->toSql());
        $this->info("With bindings: " . json_encode($query->getBindings()));
        
        $sitesToNotify = $query->get();
        
        $this->info("Found {$sitesToNotify->count()} sites to notify");

        $count = 0;
        
        foreach ($sitesToNotify as $site) {
            $this->info("Processing site for notification: ID {$site->id}, Name: {$site->name}, Expires: {$site->expires_at}");
            
            // Send notification email
            if (!empty($site->email)) {
                try {
                    $this->info("Sending email to: {$site->email}");
                    Mail::to($site->email)->send(new SiteDeletionNotification($site));
                    
                    // Update the site to mark notification as sent
                    $site->deletion_notification_sent = true;
                    $site->save();
                    
                    $count++;
                    
                    $this->info("Sent deletion notification for site: {$site->name} ({$site->domain})");
                } catch (\Exception $e) {
                    $this->error("Failed to send email: " . $e->getMessage());
                }
            } else {
                $this->warn("No email address for site {$site->id}");
            }
        }
        
        $this->info("Sent {$count} deletion notifications");
    }
}
