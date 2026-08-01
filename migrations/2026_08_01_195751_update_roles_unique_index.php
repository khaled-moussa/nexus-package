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
            // Remove old unique index
            $table->dropUnique(['name', 'guard_name']);

            $table->unique([
                'name',
                'guard_name',
                'panel',
                'tenant_id',
                'tenant_type'
            ], 'roles_unique_per_tenant_panel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop new unique index
            $table->dropUnique('roles_unique_per_tenant_panel');

            // Restore old unique index EXACTLY as before
            $table->unique(
                [
                    'name',
                    'guard_name',
                    'panel',
                    'tenant_id',
                    'tenant_type'
                ],
                'roles_unique_per_tenant_panel'
            );
        });
    }
};
