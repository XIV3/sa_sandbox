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
            $table->dropColumn('load_average');
            $table->dropColumn('memory_usage');
            $table->dropColumn('disk_usage');
            $table->dropColumn('server_data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('selected_servers', function (Blueprint $table) {
            $table->float('load_average')->nullable()->comment('CPU load average in percentage');
            $table->float('memory_usage')->nullable()->comment('Memory usage in percentage');
            $table->float('disk_usage')->nullable()->comment('Disk usage in percentage');
            $table->json('server_data')->nullable()->comment('Additional server data from API');
        });
    }
};
