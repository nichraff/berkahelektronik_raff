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
        'harga',    
        'diskon',   
        'garansi', 
        'detail', 
        'image'
    ];
    
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
}