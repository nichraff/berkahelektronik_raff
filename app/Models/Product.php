<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori', 
        'brand', 
        'judul',   
        'model',
        'stok',   
        'harga',    
        'diskon',   
        'garansi', 
        'detail', 
        'image_url'  // ← DIUBAH dari 'image' menjadi 'image_url'
    ];
    
    // Accessor untuk harga akhir
    public function getHargaAkhirAttribute()
    {
        $harga = $this->harga;
        $diskon = $this->diskon ?? 0;
        return $harga - ($harga * $diskon / 100);
    }
    
    // Relationship dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori', 'id');
    }

    // Scope untuk mendapatkan produk terbaru
    public function scopeTerbaru($query)
    {
        return $query->orderBy('id', 'desc')->limit(1);
    }
}