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
        Schema::create('exchange_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('transaction_id')->constrained('exchange_transactions', 'id');
            $table->foreignId('bottle_type_id')->constrained();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('points_earned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exchange_transaction_details');
    }
};
