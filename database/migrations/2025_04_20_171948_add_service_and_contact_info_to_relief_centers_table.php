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
        Schema::table('relief_centers', function (Blueprint $table) {
            $table->string('service')->after('capacity')->nullable(); // Add the service column
            $table->string('contact_info')->after('service')->nullable(); // Add the contact_info column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('relief_centers', function (Blueprint $table) {
            $table->dropColumn('service'); // Remove the service column
            $table->dropColumn('contact_info'); // Remove the contact_info column
        });
    }
};
