<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->integer('qty')->default(1);
            $table->decimal('harga', 15, 2);        // harga asli
            $table->decimal('harga_akhir', 15, 2);  // harga setelah diskon
            $table->timestamps();

            // relasi
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
