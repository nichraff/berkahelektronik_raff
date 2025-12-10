<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');                // Kode invoice unik
            $table->decimal('total', 15, 2);          // total bayar
            $table->string('status')->default('pending'); // pending, paid, failed
            $table->string('stripe_session_id')->nullable(); // ID checkout Stripe
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
