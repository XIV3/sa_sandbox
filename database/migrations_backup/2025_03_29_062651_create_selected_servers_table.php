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
            $table->string('status')->default('active');
            $table->float('load_average')->nullable()->comment('CPU load average in percentage');
            $table->float('memory_usage')->nullable()->comment('Memory usage in percentage');
            $table->float('disk_usage')->nullable()->comment('Disk usage in percentage');
            $table->json('server_data')->nullable()->comment('Additional server data from API');
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
