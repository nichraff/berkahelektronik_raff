<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_products_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Kolom untuk relasi ke tabel 'categories'
            $table->unsignedBigInteger('kategori'); // FIX: Menggunakan 'kategori'

            $table->string('brand');
            $table->string('judul'); 
            $table->string('model'); 
            $table->decimal('harga', 15, 2); 
            $table->integer('diskon')->default(0)->nullable(); 
            $table->string('garansi')->nullable();
            $table->text('detail');
            $table->string('image')->nullable();

            $table->timestamps();

            // Definisi Foreign Key
            $table->foreign('kategori')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};