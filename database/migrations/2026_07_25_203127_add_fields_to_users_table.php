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
            Schema::table('users', function (Blueprint $table) {
        $table->string('phone')->nullable()->after('email');
        $table->enum('role', ['resident', 'admin', 'driver'])->default('resident')->after('phone');
        $table->string('address')->nullable()->after('role');
        $table->decimal('latitude', 10, 7)->nullable()->after('address');
        $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['phone', 'role', 'address', 'latitude', 'longitude']);
    });
        
    }
};
