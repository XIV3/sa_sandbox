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
        Schema::table('selected_servers', function (Blueprint $table) {
            $table->string('connection_status')->default('unknown')
                  ->comment('Server connection status: connected, disconnected, or unknown');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('selected_servers', function (Blueprint $table) {
            $table->dropColumn('connection_status');
        });
    }
};
