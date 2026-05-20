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
        Schema::create('redemption_requests', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained();
            $table->unsignedInteger('points_used');
            $table->unsignedBigInteger('amount');
            // TODO: method enum 'cash' 'e-wallet'
            $table->string('method', 20);
            $table->string('bank_name', 100)->nullable();
            $table->string('recipient_account', 100)->nullable();
            // TODO: status enum 'pending' 'approved' 'rejected', default use 'pending'
            $table->string('status');
            $table->text('rejection_note')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('redemption_requests');
    }
};
