<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->string('cloudflare_record_id')->nullable()->comment('Cloudflare DNS record ID');
            $table->boolean('has_dns_record')->default(false)->comment('Flag to indicate if a DNS record has been created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('cloudflare_record_id');
            $table->dropColumn('has_dns_record');
        });
    }
};
