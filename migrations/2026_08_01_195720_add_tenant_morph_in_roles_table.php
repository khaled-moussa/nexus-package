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
        Schema::table('roles', function (Blueprint $table) {
            // Drop existing timestamps
            $table->dropTimestamps();

            // Add polymorphic tenant (team OR branch)
            $table->nullableMorphs('tenant');

            // Re-add timestamps after tenant columns
            $table->timestamps()->after('tenant_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop tenant polymorphic columns
            $table->dropMorphs('tenant');

            // Drop timestamps (added in up)
            $table->dropTimestamps();

            // Re-add timestamps in original position
            $table->timestamps();
        });
    }
};
