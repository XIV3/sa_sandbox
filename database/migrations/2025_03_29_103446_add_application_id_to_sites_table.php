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
            $table->string('application_id')->nullable()->comment('ServerAvatar application ID');
            $table->string('system_username')->nullable()->comment('ServerAvatar system username');
            $table->string('wp_username')->nullable()->comment('WordPress admin username');
            $table->string('database_name')->nullable()->comment('MySQL database name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn([
                'application_id',
                'system_username',
                'wp_username',
                'database_name'
            ]);
        });
    }
};
