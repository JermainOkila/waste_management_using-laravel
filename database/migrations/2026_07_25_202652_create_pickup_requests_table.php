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
        Schema::create('pickup_requests', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('truck_id')->nullable()->constrained()->nullOnDelete();
        $table->text('notes')->nullable();
        $table->string('pickup_address');
        $table->decimal('pickup_lat', 10, 7)->nullable();
        $table->decimal('pickup_lng', 10, 7)->nullable();
        $table->decimal('amount', 10, 2)->default(0);
        $table->enum('status', [
            'pending_payment',
            'paid',
            'dispatched',
            'in_transit',
            'picked_up',
            'cancelled'
        ])->default('pending_payment');
        $table->timestamp('dispatched_at')->nullable();
        $table->timestamp('picked_up_at')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_requests');
    }
};
