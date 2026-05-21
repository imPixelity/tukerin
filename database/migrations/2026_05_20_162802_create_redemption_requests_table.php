<?php

use App\Enums\RedemptionStatus;
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
            $table->foreignUuid('user_id')->constrained()->restrictOnDelete();
            $table->unsignedInteger('points_used');
            $table->unsignedBigInteger('amount');
            $table->string('method', 20);
            $table->string('recipient_provider', 100)->nullable();
            $table->string('recipient_account_number', 100)->nullable();
            $table->string('status')->default(RedemptionStatus::PENDING->value);
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
