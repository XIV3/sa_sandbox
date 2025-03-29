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
            $table->string('database_id')->nullable()->comment('Database ID from ServerAvatar API');
            // database_user_id column removed as it's not needed
            $table->string('database_password')->nullable()->comment('Database Password');
            $table->string('database_host')->nullable()->comment('Database Host');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropColumn('database_id');
            // database_user_id column removed from down method as well
            $table->dropColumn('database_password');
            $table->dropColumn('database_host');
        });
    }
};
