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
        Schema::create('selected_servers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('server_id')->comment('Server ID from ServerAvatar API');
            $table->string('name');
            $table->string('ip_address');
            $table->string('web_server')->nullable();
            $table->string('database_type')->nullable();
            $table->unsignedInteger('cores')->nullable();
            $table->string('connection_status')->default('unknown')
                  ->comment('Server connection status: connected, disconnected, or unknown');
            $table->timestamps();
            
            // Ensure we don't add the same server twice
            $table->unique('server_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selected_servers');
    }
};
