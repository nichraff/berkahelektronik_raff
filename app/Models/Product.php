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
        'image' 
    ];
    
    // Accessor untuk URL gambar lengkap 
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori'); 
    }

    public function getHargaAkhirAttribute()
    {
        $harga = $this->attributes['harga'];
        $diskon = $this->attributes['diskon'] ?? 0; 

        $harga_akhir = $harga - ($harga * $diskon / 100);

        return $harga_akhir;
    }

    // Scope untuk mendapatkan produk terbaru
    public function scopeTerbaru($query)
    {
        return $query->orderBy('id', 'desc')->limit(1);
    }
}