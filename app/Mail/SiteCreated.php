<?php

namespace App\Mail;

use App\Models\Site;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SiteCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The site instance.
     *
     * @var \App\Models\Site
     */
    public $site;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Site $site
     * @return void
     */
    public function __construct(Site $site)
    {
        $this->site = $site;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Your WordPress Site Has Been Created: ' . $this->site->domain;
        
        return $this->subject($subject)
                    ->markdown('emails.sites.created');
    }
}