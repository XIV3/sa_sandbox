<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use App\Models\SystemSetting;

class Site extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'domain',
        'description',
        'selected_server_id',
        'php_version',
        'server_id',
        'status',
        'is_public',
        'site_data',
        'reminder',
        'email',
        'application_id',
        'system_username',
        'wp_username',
        'database_name',
        'cloudflare_record_id',
        'has_dns_record',
        'database_id',
        'database_username',
        'database_password',
        'database_host',
        'expires_at',
        'deletion_notification_sent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'site_data' => 'array',
        'reminder' => 'boolean',
        'has_dns_record' => 'boolean',
        'is_public' => 'boolean',
        'expires_at' => 'datetime',
        'deletion_notification_sent' => 'boolean',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // Generate a UUID and set expiration time when creating a new site
        static::creating(function ($site) {
            if (!$site->uuid) {
                $site->uuid = Str::random(32);
            }
            
            // Set the expiration date based on system settings
            if (!$site->expires_at) {
                $defaultDeletionHours = SystemSetting::where('meta_key', 'default_deletion_time')->value('meta_value') ?? 72; // Default to 72 hours if not set
                $site->expires_at = now()->addHours((int) $defaultDeletionHours);
            }
        });
    }

    /**
     * Get the server that the site belongs to.
     *
     * @return BelongsTo
     */
    public function server(): BelongsTo
    {
        return $this->belongsTo(SelectedServer::class, 'selected_server_id');
    }
    
    /**
     * Get the subdomain portion of the domain
     *
     * @return string
     */
    public function getSubdomainAttribute(): string
    {
        $domainParts = explode('.', $this->domain ?? '');
        if (!empty($domainParts)) {
            return $domainParts[0];
        }
        return '';
    }
}
