<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Kolom untuk relasi
            $table->unsignedBigInteger('kategori');

            $table->string('brand');
            $table->string('judul'); 
            $table->string('model'); 
            $table->decimal('harga', 15, 2); 
            $table->integer('diskon')->default(0)->nullable(); 
            $table->string('garansi')->nullable();
            $table->text('detail');

            // Jadi URL gambar dari Google Drive:
            $table->string('image_url')->nullable();

            $table->timestamps();

            $table->foreign('kategori')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
