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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 32)->unique()->comment('32 character unique identifier for the site');
            $table->string('name');
            $table->string('domain');
            $table->text('description')->nullable();
            $table->foreignId('selected_server_id')->constrained('selected_servers')->onDelete('cascade');
            $table->string('php_version')->nullable();
            $table->string('server_id')->comment('External server ID from API');
            $table->string('status')->default('active');
            $table->json('site_data')->nullable()->comment('Additional site configuration');
            $table->timestamp('expires_at')->nullable()->comment('When this site will be automatically deleted');
            $table->timestamps();
            $table->index('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
