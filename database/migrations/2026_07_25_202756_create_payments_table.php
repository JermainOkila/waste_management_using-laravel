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
         Schema::create('payments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pickup_request_id')->constrained()->cascadeOnDelete();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('phone');
        $table->decimal('amount', 10, 2);
        $table->string('checkout_request_id')->nullable();
        $table->string('mpesa_receipt')->nullable();
        $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
        $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
