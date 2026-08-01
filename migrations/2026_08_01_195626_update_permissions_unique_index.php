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
        Schema::table('permissions', function (Blueprint $table) {
            // Remove old unique in spatie permissions table
            $table->dropUnique(['name', 'guard_name']);

            // Add new unique index considering the panel column
            $table->unique(['name', 'guard_name', 'panel']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropUnique(['name', 'guard_name', 'panel']);

            $table->unique(['name', 'guard_name']);
        });
    }
};