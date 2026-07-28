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
            Schema::create('dispatches', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pickup_request_id')->constrained()->cascadeOnDelete();
        $table->foreignId('truck_id')->constrained()->cascadeOnDelete();
        $table->foreignId('dispatched_by')->constrained('users')->cascadeOnDelete();
        $table->timestamp('dispatched_at')->useCurrent();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
