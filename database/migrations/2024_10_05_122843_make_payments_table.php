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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User making the payment
            $table->foreignId('business_id')->constrained()->onDelete('cascade'); // Related business

            $table->decimal('paid_amount', 10, 2)->nullable(); // Payment amount
            $table->decimal('initial_price', 10, 2)->nullable(); // Payment amount

            $table->dateTime('payment_date')->nullable(); // Date of payment
            $table->string('month')->nullable(); // The month for which payment was made
            $table->boolean('status')->default(false); // Payment status (false = unpaid, true = paid)

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
