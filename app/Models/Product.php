<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand',
        'judul',
        'model',
        'harga',
        'diskon',
        'garansi',
        'detail',
        'stok',
        'image_url'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getHargaAkhirAttribute()
    {
        $harga = $this->harga;
        $diskon = $this->diskon ?? 0;

        return $harga - ($harga * $diskon / 100);
    }
}
